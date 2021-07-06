<?php

namespace App\Http\Controllers;

use App\Group;
use App\Group_User;
use Illuminate\Http\Request;
use App\Support\Collection;
use App\Test;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return $groups
     */
    protected function groupToArray($groups)
    {

        $group_ids = array();

        if (Str::contains($groups, ',')) {
            foreach (explode(",", $groups) as $name) {
                $group = Group::where('name', $name)->first();
                $group_ids[] = $group->id;
            }
        } else {
            $group = Group::where('name', $groups)->first();
            $group_ids[] = $group->id;
        }

        return $group_ids;
    }

    /**
     * Get the header from url
     *
     * @return result
     */
    private function header($url, $format)
    {
        $result = Http::withHeaders([
            'WWW-Authenticate' => $this->token
        ])->get($url . '/' . $format);

        return $result;
    }

    /**
     * Show the candidates.
     * Jira ajax
     * @return Resoureces/view
     */
    function index(Request $request)
    {

        $candidates = User::role(['candidate'])->get();

        if ($request->ajax()) {

            return DataTables::of($candidates)
                ->addIndexColumn()
                ->addColumn('action', function ($candidate) {
                    $action = '
                    <a class="btn btn-pill btn-light btn-sm"><i class="cil-send"></i> Урих</a>
                    <a class="btn btn-pill btn-light btn-sm"><i class="cil-chart"></i> Тайлан</a>
                    <div class="btn-group">
                        <a href="" type="button" title="Илүү" class="btn btn-pill btn-light dropdown-toggle btn-sm" data-toggle="dropdown">
                            <i class="cil-cog"> Бусад...</i>
                        </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item edit" href="' . route("candidate.edit", $candidate->id) . '" data-toggle="tooltip"  data-id="' . $candidate->id . '" data-original-title="Edit"><i class="cil-pencil">&nbsp;</i> Засах</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="cil-vertical-align-bottom1">&nbsp;</i> Assessment</a>
                        <a class="dropdown-item addToGroup" data-toggle="modal"  data-id="' . $candidate->id . '"  href=""><i class="cil-user-follow">&nbsp;</i>Add to the group</a>
                        <a class="dropdown-item archive" data-toggle="modal"  href="javascript:void(0)" data-id=""  href=""><i class="cil-user-unfollow">&nbsp;</i>Archive</a>
                        <a class="dropdown-item delete" style="color:red;" href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $candidate->id . '" data-original-title="Delete"><i class="cil-trash">&nbsp;</i>Delete</a>
                    </div>
                    </div>
                <input type="checkbox" id="' . $candidate->id . '"';
                    return $action;
                })
                ->addColumn('checkbox', '<input type="checkbox" id="chkboxes" name="candidate_checkbox[]" class="participant_checkbox" value="{{$id}}" />')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('layouts.candidate.index', compact('candidates'));
    }

    /**
     * Show the form for create candidate.
     *
     * @return Views
     */
    function create()
    {
        $groups = Group::all();
        return view('layouts.candidate.create', compact('groups'));
    }

    public function keyGenerator()
    {
        return Str::upper(Str::random(1)) . Str::random(4) . rand(5, 10000);
    }

    public function store(Request $request)
    {
        $data = $this->validateUser(null);
        $user = User::create(
            [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'password' => Hash::make($this->keyGenerator()),
                'group_id' => $request->group_id,
                'created_by' => auth()->id(),
                'email' => $request->email,
                'gender' => $request->gender,
                'phone' => $request->phone
            ]
        );

        $data['groups'] = $this->groupToArray($request->groups);

        if ($user) {
            for ($i = 0; $i < count($data['groups']); $i++) {
                $array[] = array(
                    'group_id' => $data['groups'][$i],
                    'user_id' => $user->id
                );
            }
            Group_User::insert($array);
            $user->assignRole('candidate');
        } else {
            abort(500, 'Error');
        }
        // candidate create in cdc.centraltest.com
        return redirect()->route('candidate.index')->with('success', 'Харилцагч амжилттай бүртгэлээ!');
    }

    /*
     * Validation user function
    */
    public function validateUser($id = null)
    {
        return request()->validate(
            [
                'firstname' => ['required', ['string']],
                'lastname' => ['required', ['string']],
                'email' => 'required|email|unique:users,email,' . $id . ',id',
                'phone' => ['required', 'numeric'],
                'dob' => ['required', 'date', 'max:10'],
                'gender' => ['required']
            ]
        );
    }

    // Candiates by Group
    function group(Request $request)
    {
        // return $results;
        $group = $this->header('https://app.centraltest.com/customer/REST/list/group', 'json');
        $groups = json_decode($group);

        if ($request->group_id) {
            $results = Http::withHeaders([
                'WWW-Authenticate' => $this->token
            ])->get(
                'https://app.centraltest.com/customer/REST/retrieve/group/json',
                [
                    'id' => $request->group_id
                ]
            );

            $group_id = $request->group_id;
        } else
            $group_id = null;


        $canditateList = array();

        if (isset($results) && $results['candidates']) {
            foreach ($results['candidates'] as $candidate) {
                $candidates = Http::withHeaders(['WWW-Authenticate' => $this->token])->get(
                    'https://app.centraltest.com/customer/REST/retrieve/candidate/json',
                    [
                        'id' =>  $candidate['id']
                    ]
                );
                $canditateList[] = json_decode($candidates);
            }
        } elseif (isset($request->email)) {
            $candidates = Http::withHeaders(['WWW-Authenticate' => $this->token])->get(
                'https://app.centraltest.com/customer/REST/retrieve/candidate/json',
                [
                    'email' =>  $request->email
                ]
            );
            $canditateList[] = json_decode($candidates);
        }


        return $canditateList;

        // return view('layouts.candidate.list', compact('canditateList', 'groups', 'group_id'));
    }

    // get list title
    function show()
    {
        $results = $this->header('https://app.centraltest.com/customer/REST/list/title', 'json');
        $data = json_decode($results);
        // return view('layouts.candidate.group', compact('data'));
    }

    public function getToken()
    {
        return $this->token;
    }

    public function assessments($candidate_id = null)
    {
        // https://app.centraltest.com/customer/REST/assessment/paginate/completed/
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token
        ])->GET(
            'https://app.centraltest.com/customer/REST/assessment/completed/json',
            [
                'candidate_id' => $candidate_id
            ]
        );

        $assessments = json_decode($response);

        // return $assessments;
        // тухайн хэрэглэгчийн утга буцсан байвал тухайн id-г аваад
        foreach ($assessments as $item) {
            $test = Test::find($item->test_id);
            $item->test = $test->label;
        }
        // тухайн тестийн утгуудыг авна
        // mестийн үр дүнг буцааж авна.
        return view('layouts.candidate.assessments', compact('assessments'));
    }

    public function import()
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token
        ])->post(
            'https://app.centraltest.com/customer/REST/candidate/import/json',
            [
                'candidates' => [array("id" => 817042)]
            ]
        );

        return $response;
    }

    public function retrieve()
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token
        ])->get(
            'https://app.centraltest.com/customer/REST/retrieve/candidate/json',
            [
                'id' => 817042
            ]
        );
        return $response;
    }

    public function contract()
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token
        ])->post('https://app.centraltest.com/customer/REST/list/contract/json');

        return $response;
    }

    //  // get Group
    //  public function group(){
    //     $response = Http::withHeaders([
    //         'WWW-Authenticate'=> $this->token
    //     ])->post('https://app.centraltest.com/customer/REST/list/group/json');
    //     $data = json_decode($response);
    //     return view('layouts.candidate.group', compact('data'));
    // }

    function getCompany()
    {
        $result = $this->header('https://app.centraltest.com/customer/REST/company/giveCredits/', 'json');
        return $result;
    }

    // Get Test Factors
    public function getTest()
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token
        ])->get(
            'https://app.centraltest.com/customer/REST/assessment/test_factors/json',
            [
                'test_id' => 13
            ]
        );

        return $response;
    }

    // get Test info
    public function testList()
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token
        ])->get(
            'https://app.centraltest.com/customer/REST/list/test/json',
            []
        );
        return $response;
    }
}
