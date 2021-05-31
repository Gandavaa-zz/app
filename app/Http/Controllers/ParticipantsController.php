<?php
namespace App\Http\Controllers;

use App\Group;
use App\Test;
use App\Participant;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables ;
use App\Group_User;
// use App\Participant;


class ParticipantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
    */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $users = Participant::with('tests')->get();
            $users = DB::connection('mysql2')->table('aauth_users')
                ->selectRaw("aauth_users.id as id, email, CONCAT(firstname, ', ',lastname) AS fullname, test, company, aauth_users.created_at, deleted")
                ->leftJoin('company', 'company.id', '=', 'aauth_users.company_id')
                ->leftJoin(DB::connection('mysql2')->raw('(SELECT a.user_id, GROUP_CONCAT(DISTINCT test SEPARATOR ", ") as test
                               FROM unitedco_test.user_test a
                               join unitedco_test.aauth_users b on a.user_id = b.id
                               join unitedco_test.test c on a.test_id = c.test_id
                           group by user_id) as UserTests'),
                           function($join){
                               $join->on('aauth_users.id', '=', 'UserTests.user_id');
                           })
                ->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function($user){
                    $btn = '
                    <a class="btn btn-pill btn-light btn-sm"><i class="cil-send"></i> Урих</a>
                    <a class="btn btn-pill btn-light btn-sm"><i class="cil-chart"></i> Тайлан</a>
                    <div class="btn-group">
                        <a href="" type="button" title="Илүү" class="btn btn-pill btn-light dropdown-toggle btn-sm" data-toggle="dropdown">
                            <i class="cil-cog"> Бусад...</i>
                        </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item edit" href="' .route("participants.edit", $user->id) . '" data-toggle="tooltip"  data-id="' . $user->id . '" data-original-title="Edit"><i class="cil-pencil">&nbsp;</i> Засах</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="cil-vertical-align-bottom1">&nbsp;</i> Assessment</a>
                        <a class="dropdown-item addToGroup" data-toggle="modal"  data-id="' . $user->id . '"  href=""><i class="cil-user-follow">&nbsp;</i>Add to the group</a>
                        <a class="dropdown-item archive" data-toggle="modal"  href="javascript:void(0)" data-id=""  href=""><i class="cil-user-unfollow">&nbsp;</i>Archive</a>
                        <a class="dropdown-item delete" style="color:red;" href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $user->id . '" data-original-title="Delete"><i class="cil-trash">&nbsp;</i>Delete</a>
                    </div>
                  </div>
              <input type="checkbox" id="' . $user->id . '"';
                return $btn;
            })
            // ->addColumn('name', function($row) {
            //     $options = '';
            //     $myArray = explode(',', $row->name);
            //     foreach ($myArray as $name) {
            //         $options .= $name;
            //     }
            //     $return = $options;
            //     return $return;
            // })
            ->addColumn('checkbox', '<input type="checkbox" id="chkboxes" name="participant_checkbox[]" class="participant_checkbox" value="{{$id}}" />')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('layouts.participants.index');
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
        return view('layouts.participants.show', compact('user'));
    }

    /**
     * Create user view here
     *
     */
    public function create()
    {
        $roles = Role::all();

        return view('layouts.participants.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $data = $this->validateUser(null);
        $data['password'] = Hash::make($this->keyGenerator());
        $data['group_id'] = $request->group_id;
        $data['created_by'] = auth()->id();
        $data['group_id'] = $request->group_id;
        $data['firstname'] = $request->firstname;
        $data['lastname'] = $request->lastname;
        $data['email'] = $request->email;
        $data['gender'] = $request->gender;
        $data['phone'] = $request->phone;
        var_dump($data);

        $user = User::create( $data );
        $id = Auth::user()->id;
        $data['created_by'] = $id;
        $data['groups'] = $this->groupToArray(request('groups'));

        $array = array();
        $lastInsertedId = $user->id;

        for ($i = 0;$i < count( $data['groups']);$i++)
        {
            $array[] = array(
                'group_id' => $data['groups'][$i],
                'user_id' => $lastInsertedId
            );
        }
        if ($user)
        {
            $group = Group_User::insert($array);
        }
        else
        {
            App::abort(500, 'Error');
        }

        if ($role = request('role'))
        {
            $user->assignRole($role);
        }

        return redirect()->route('participants.index')->with('success', 'Харилцагч амжилттай бүртгэлээ!');
    }

    protected function groupToArray($groups){
        $group_ids = array();

        if(Str::contains($groups, ',')){
            foreach(explode(",", $groups) as $name)
            {
                $group = Group::where('name', $name)->first();
                $group_ids[] = $group->id;
            }
            return $group_ids;

        }else{
            $group = Group::where('name', $groups)->first();
            return $group->id;
        }
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

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(User $user)
    {
        $groups = Group_User::whereIn('user_id', array($user->id))->get();

        $groupids = array();

        $group_names = null;

        if (count($groups) > 0)
        {
            foreach ($groups as $group)
            {
                array_push($groupids, $group->group_id);
            }
            $group_names = Group::whereIn('id', $groupids)->get();
        }

        return view('layouts.participants.edit', ['user' => $user])->with("group_names", $group_names);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        request()->validate([
            'firstname' => ['required', ['string']],
            'lastname' => ['required', ['string']],
            'email' => ['required', 'string', 'email', 'max:255'],
            'dob' => ['required', ['string']],
            'register' => ['required', ['string']],
            'phone' => ['required', ['string']],
            'gender' => ['required', ['string']],
            'address' => ['required', ['string']],
            'groups' => ['required']
        ]);

        $user->update([
            'firstname'=> request()->input('firstname'),
            'lastname'=> request()->input('lastname'),
            'email'=> request()->input('email'),
            'dob'=> request()->input('dob'),
            'register'=> request()->input('register'),
            'phone'=> request()->input('phone'),
            'gender'=> request()->input('gender'),
            'address'=> request()->input('address')
        ]);

        if( request()->file('avatar')){
            request()->validate(['avatar' => ['required', ['image']]]);
            $user->update(['avatar_path'=> request()->file('avatar')->store('avatar', 'public') ]);
        }

        $user->groups()->attach($this->groupToArray(request('groups')));

        return redirect()->route('participants.index')->with('success', 'Харилцагчын мэдээллийг амжилттай бүртгэлээ');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        User::find($id)->delete();

        return response()
            ->json(['msg' => 'Participant deleted successfully.']);
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
        return request()->validate(['firstname' => ['required', ['string']], 'lastname' => ['required', ['string']], 'email' => 'required|email|unique:users,email,' . $id . ',id', 'phone' => ['required', 'string', 'max:10'], 'register' => ['required', 'string', 'max:10'], 'dob' => ['required', 'date', 'max:10'], 'address' => ['required', 'string', 'max:100'], 'gender' => ['required'], 'role' => ['sometimes', 'required']
        // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        // 'tests' => 'exists:tests,id'
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

}

