<?php
namespace App\Http\Controllers;

use App\Candidate;
use App\Company;
use App\Group;
use App\Participant;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables ;
use App\Test;
use Illuminate\Support\Facades\Http;

class CandidatesController extends Controller
{
    /**
     * Display a listing of the resource.
     * Тухайн хэрэглэгчийг candidate_id-тай холбогдсон эсэхийг харуулна
     * <a class="dropdown-item addToGroup" data-toggle="modal"  data-id="' . $user->id . '"  href=""><i class="cil-user-follow">&nbsp;</i>Add to the group</a>
     * <a class="dropdown-item archive" data-toggle="modal"  href="javascript:void(0)" data-id=""  href=""><i class="cil-user-unfollow">&nbsp;</i>Archive</a>
    */
    public function index(Request $request)
    {
        $users = Candidate::with('groups')->get();

        if ($request->ajax()) {
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function($user){
                    $btn = '
                    <a class="btn btn-warning btn-light btn-sm">
                        <i class="cil-chart"></i> Тайлан</a>
                    <div class="btn-group">
                        <a href="" type="button" title="Илүү" class="btn btn-light dropdown-toggle btn-sm" data-toggle="dropdown">
                            <i class="cil-cog"> Бусад...</i>
                        </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item edit" href="' .route("candidate.edit", $user->id) . '" data-toggle="tooltip"  data-id="' . $user->id . '" data-original-title="Edit"><i class="cil-pencil">&nbsp;</i> Засах</a>
                        <a class="dropdown-item" href="'. route("candidate.assessment", $user->id) . '"><i class="cil-arrow-left"></i> Тест татах</a>
                        <a class="dropdown-item delete" style="color:red;" href="javascript:destroy('.$user->id.')" data-toggle="tooltip" id="delete" data-id="' . $user->id . '" data-original-title="Delete"><i class="cil-trash">&nbsp;</i>Delete</a>
                    </div>
                  </div>
              <input type="checkbox" id="' . $user->id . '"';
                return $btn;
            })
            ->addColumn('checkbox', '<input type="checkbox" id="chkboxes" name="participant_checkbox[]" class="participant_checkbox" value="{{$id}}" />')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('layouts.candidate.index');
    }

    public function assessment_table(Request $request)
    {
        if ($request->ajax())
        {
            $data = Test::all();

            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row)
            {
                $btn = '
                <div class="btn-group">
                <button type="button" class="btn btn-success"><i class="cil-media-play"></i> Activate</button>
                <button type="button" class="btn btn-primary"><i class="cil-send"></i> Invite</button>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                     Other
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#"><i class="cil-newspaper"></i> Participant Report</a>
                    <a class="dropdown-item" href="#"><i class="cil-folder"></i>  History</a>
                    <a class="dropdown-item" href="#" style="color:red"><i class="cil-trash"></i> Delete</a>
                  </div>
                </div>
              </div><input type="checkbox" id="' . $row->id . '"';
                return $btn;
            })->addColumn('checkbox', '<input type="checkbox" id="chkboxes" name="participant_checkbox[]" class="participant_checkbox" value="{{$id}}" />')
                ->rawColumns(['action'])
                ->make(true);
        }
        // return view('layouts.settings.participants.index');
    }

    public function show(User $user)
    {

    }

    /**
     * Get group values
     * Connect APi get result of user email!    *
     */
    function assessment(Candidate $candidate){
        // Тухайн candidate-n candidate_id -р шалгана, Candidate id утгагүй байвал
        if ( $candidate->candidate_id){
            $newCandidate = Http::withHeaders([
                'WWW-Authenticate'=> $this->token
            ])->get('https://app.centraltest.com/customer/REST/retrieve/candidate/json',
            [
                'id' => $candidate->candidate_id
            ]);
        }else{
            $newCandidate = Http::withHeaders([
                'WWW-Authenticate'=> $this->token
            ])->get('https://app.centraltest.com/customer/REST/retrieve/candidate/json',
            [
                'email' =>  $candidate->email
            ]);
        }

        $Candidate = json_decode($newCandidate, true);

        // Хэрвээ email- утгагүй байвал тухайн хэрэглэгчийг татаж авах боломжгүй болно!
        if ( isset($Candidate['error'])) {
            return redirect()->route('candidate.index')->with('success', 'Харилцагч олдсонгүй таны имэйл хаягаар Centraltest.com дээр бүртгэгдээгүй байна!');
        }else{
            // Candidate-н имэйл хаягаар утгийг татаж авч Update хийнэ
            if( $Candidate['title_id'] == "2") $gender = 'female';
            else $gender = 'male';

            $candidate->update([
                'candidate_id'=> $Candidate['id'],
                'gender'=> $gender,
            ]);

            // Тестийн жагсаалтыг харуулах
            $response = Http::withHeaders([
                'WWW-Authenticate'=> $this->token
            ])->GET('https://app.centraltest.com/customer/REST/assessment/completed/json',
            [
                'candidate_id' => $Candidate['id']
            ]);

            $assessments = json_decode($response);

            foreach ($assessments as $item) {
                $test = Test::find($item->test_id);
                $item->test = $test->label;
            }

            return view('layouts.candidate.assessments', compact('assessments', 'candidate'));
        }

    }

    /**
     * Create user view here
     *
     */
    public function create()
    {
        $roles = Role::all();
        $company = Company::all();
        return view('layouts.candidate.create', ['roles' => $roles, 'company'=>$company]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateUser(null);
        $password = $this->keyGenerator();

        $user = Candidate::create(
            [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'company_id' => $request->company_id,
                'email' => $request->email,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'birthday' => $request->birthday,
                'pass' => hash_password($password, 0),
                'word' => $password
            ]
        );
        $user->pass= hash_password($password, $user->id);
        $user->save();
        return redirect()->route('candidate.index')->with('success', 'Харилцагч амжилттай бүртгэлээ!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Candidate $candidate)
    {
        $company = Company::all();

        return view('layouts.candidate.edit', ['candidate' => $candidate])->with("company", $company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        request()->validate([
            'firstname' => ['required', ['string']],
            'lastname' => ['required', ['string']],
            'email' => ['required', 'string', 'email', 'max:255'],
            'birthday' => ['required', ['string']],
            'gender' => ['required', ['string']],
            'company_id' => ['required']
            // 'address' => ['required', ['string']],
        ]);

        $candidate->update([
            'firstname'=> request()->input('firstname'),
            'lastname'=> request()->input('lastname'),
            'email'=> request()->input('email'),
            'birthday'=> request()->input('birthday'),
            'phone'=> request()->input('phone'),
            'gender'=> request()->input('gender'),
            'company_id'=> request()->input('company_id')
        ]);
        return redirect()->route('candidate.index')->with('success', 'Харилцагчын мэдээллийг амжилттай бүртгэлээ');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Candidate $candidate)
    {
        // хэрэглэгч тухайн test-тэй холбоотой байна уу?
        if(sizeof($candidate->tests)>0)
            return response()
                 ->json(['msg' => 'Утгах боломжгүй байна, учир нь тухайн хэрэглэгчид тест оноосон байна!',
                         'status' => 'error']);
        else{
            $candidate->delete();
            return response()->json([
                    'msg' => 'Хэрэглэгчийг амжилттай устгалаа.',
                    'status'=>'success'
                    ]);
        }
    }

    public function deleteMultiple(Request $request)
    {
        $participant_id_array = $request->input('id');

        $data = User::whereIn('id', $participant_id_array);

        if ($data->delete()){
            return response()->json(['msg' => 'Selected Participants deleted successfully.']);
        }
    }

    /*
     * Validation user function
    */
    public function validateUser($id=null)
    {
        return request()->validate(
                ['firstname' => ['required', ['string']],
                'lastname' => ['required', ['string']],
                'email' => 'required|email|unique:aauth_users,email,' . $id . ',id',
                'phone' => ['required', 'string', 'max:10'],
                'birthday' => ['required', 'date', 'max:10'],
                'gender' => ['required'],
                'role' => ['sometimes', 'required'],
                'company_id' => ['required']
        ]);
    }

     // used for populate data for group dropdown
     public function rolePermission(Request $request)
     {
        $search = $request->search;
        if ($search == ''){
            $groups = Group::orderby('name', 'asc')->select('id', 'name')->get();
        }else{
             $groups = Group::orderby('name', 'asc')->select('id', 'name')
                 ->where('name', 'like', '%' . $search . '%')->get();
        }

        $response = array();

        foreach ($groups as $group){
            $response[] = array(
                 "id" => $group->id,
                 "name" => $group->name
            );
        }
        echo json_encode($response);
        exit;
     }

    public function keyGenerator()
    {
        return Str::upper(Str::random(1)) . Str::random(4) . rand(5, 10000);
    }

    public function import()
    {
        $where = array( 'id' => 1);
        $user = User::where($where)->first();
        return view('layouts.participants.import', compact('user'));
    }

    public function import_excel(Request $request)
    {
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('select_file')->getRealPath();

        $data = Excel::load($path)->get();

        if($data->count() > 0)
        {
            foreach($data->toArray() as $key => $value)
            {
                foreach($value as $row)
                {
                    $insert_data[] = array(
                        'firstname'  => $row['firstname'],
                        'email'   => $row['email'],
                        'lastname'   => $row['lastname'],
                        'phone'    => $row['phone'],
                        'gender'  => $row['gender'],
                        'address'   => $row['address']
                    );
                }
            }

            if (!empty($insert_data))
            {
                DB::table('user ')->insert($insert_data);
            }
        }
            return back()->with('success', 'Excel Data Imported successfully.');

    }

    public function list()
    {
        // show view_data and values here
        return User::with('groups')->get();

        return view('layouts.app');

    }

    public function getList(){
        DB::enableQueryLog();
        $participants = Participant::with('tests')->find(1);
        return $participants->tests;
    }

    public function addToGroup(Request $request)
    {
        $data = $this->groupToArray(request('groups'));

        for ($i = 0; $i < count($data); $i++)
        {
            $user = Group_User::updateOrCreate(['user_id' => $request->user_id, ], ['group_id' => $data[$i]]);
        }

        $request->session()
            ->flash('message', 'Group-д амжилттай бүртгэлээ!');

        return redirect()
            ->route('participants.index');
    }

    public function group()
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token
        ])->get('https://app.centraltest.com/customer/REST/list/group/json');

        $api_groups = json_decode($response, true);
        
        // insert groups into group
        foreach ($api_groups as $key => $group) {
            if (!Group::where('id', intval($group['id']))->exists()) {
                Group::create([
                    'id' => $group['id'],
                    'name' => $group['name']
                ]);
            }
        }

        $groups = Group::paginate(15);

        // return $groups;
        return view('layouts.settings.group.index', compact('groups'));
    }

}
