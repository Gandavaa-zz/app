<?php
namespace App\Http\Controllers;

use App\Group;
use App\Group_User;
use App\Http\Controllers\Controller;
use App\Test;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\POST;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

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

        if ($request->ajax())
        {
            $data = DB::table('users')->select("users.id", DB::raw("(GROUP_CONCAT(groups.name)) as `name`") , DB::raw("CONCAT(tb2.lastname, ' ', tb2.firstname) as created_by") , DB::raw("CONCAT(users.lastname, ' ', users.firstname) as fullname") , "users.email", "users.phone", "users.created_at")
                ->leftJoin("group_user", "group_user.user_id", "=", "users.id")
                ->leftJoin("groups", "groups.id", "=", "group_user.group_id")
                ->leftJoin("users as tb2", "users.created_by", "=", "tb2.id")
                ->groupBy('users.id', 'users.created_at', 'users.phone', 'users.email', 'users.firstname', 'users.lastname', 'tb2.firstname', 'tb2.lastname')
                ->orderByDesc('id')
                ->get();

            return FacadesDataTables::of($data)->addIndexColumn()->addColumn('action', function ($row)
            {
                $btn = '
                    <a class="btn btn-pill btn-light"><i class="cil-send"></i> Invite</a>
                    <a class="btn btn-pill btn-light"><i class="cil-chart"></i> Talent map</a>
                    <div class="btn-group">
                    <a href="" type="button" title="Бусад" class="btn btn-pill btn-light dropdown-toggle" data-toggle="dropdown">
                    <i class="cil-cog"> More</i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item edit" href="' . route("participants.edit", $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit"><i class="cil-pencil">&nbsp;</i> Edit</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="cil-vertical-align-bottom1">&nbsp;</i> Assessment</a>
                        <a class="dropdown-item addToGroup" data-toggle="modal"  data-id="' . $row->id . '"  href=""><i class="cil-user-follow">&nbsp;</i>Add to the group</a>
                        <a class="dropdown-item archive" data-toggle="modal"  href="javascript:void(0)" data-id=""  href=""><i class="cil-user-unfollow">&nbsp;</i>Archive</a>
                        <a class="dropdown-item delete" style="color:red;" href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete"><i class="cil-trash">&nbsp;</i>Delete</a>
                    </div>
                  </div>
              <input type="checkbox" id="' . $row->id . '"';
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

        return view('layouts.settings.participants.index');
    }

    public function assessment_table(Request $request)
    {

        if ($request->ajax())
        {
            $data = Test::all();

            return FacadesDataTables::of($data)->addIndexColumn()->addColumn('action', function ($row)
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


    public function show($id)
    {

        $user = DB::table('users')->select("users.id", DB::raw("(GROUP_CONCAT(groups.name)) as `name`") , DB::raw("CONCAT(tb2.lastname, ' ', tb2.firstname) as created_by") , DB::raw("CONCAT(users.lastname, ' ', users.firstname) as fullname") , "users.email","users.password", "users.phone", "users.created_at")
        ->leftJoin("group_user", "group_user.user_id", "=", "users.id")
        ->leftJoin("groups", "groups.id", "=", "group_user.group_id")
        ->leftJoin("users as tb2", "users.created_by", "=", "tb2.id")
        ->groupBy('users.id', 'users.created_at', 'users.phone', 'users.email', 'users.firstname', 'users.lastname', 'tb2.firstname', 'tb2.lastname', 'users.password')
        ->where('users.id', '=', $id)
        ->orderByDesc('id')
        ->get();
        return view('layouts.settings.participants.show', compact('user'));
        // return response()->json($user);

    }

    /**
     * Create user view here
     *
     */
    public function create()
    {
        $roles = Role::all();

        return view('layouts.settings.participants.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $data = $this->validateUser(null);
        $data['password'] = Hash::make($this->keyGenerator());
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

        if(Str::contains($groups, ',')){
            foreach(explode(",", $groups) as $name)
            {
                $group = Group::where('name', $name)->first();
                $group_ids[] = $group->id;
            }
        }else{
            $group = Group::where('name', $groups)->first();

            $group_ids[] = $group->id;

        }

        return $group_ids;
    }

    public function addToGroup(Request $request)
    {
        // return $request;
        // $data = $this->validateUser(null);
        // $groups = $this->groupToArray($request->groups);
        // var_dump(request('groups'));
        $data = $this->groupToArray(request('groups'));

        for ($i = 0;$i < count($data); $i++)
        {
            $user = Group_User::updateOrCreate(['user_id' => $request->user_id, ], ['group_id' => $data[$i]]);
        }

        // return $user;

        // $user->tests()->attach(request('tests'));
        $request->session()
            ->flash('message', 'Group-д амжилттай бүртгэлээ!');

        return redirect()
            ->route('participants.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(User $user, $id)
    {
        $participants = User::find($id);
        $groups = Group_User::whereIn('user_id', array(
            $id
        ))->get();
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

        return view('layouts.settings.participants.edit', compact('participants'))->with("group_names", $group_names);

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        // return request();
        // $data = $this->validateUser($id);
        // $userid = User::find($id);
        $data = User::find($id);
        $data->firstname = $request->get('firstname');
        $data->lastname = $request->get('lastname');
        $data->email = $request->get('email');
        $data->dob = $request->get('dob');
        $data->register = $request->get('register');
        $data->phone = $request->get('phone');
        $data->gender = $request->get('gender');
        $data->address = $request->get('address');
        $data->groups()->attach($this->groupToArray(request('groups')));
        $data->update();
        return redirect()->route('participants.index')->with('success', 'Харилцагч амжилттай засварлалаа!');
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
        if ($data->delete())
        {
            return response()
                ->json(['msg' => 'Selected Participants deleted successfully.']);
        }
    }

    /*
     * Validation user function
    */

    public function validateUser($id=null)
    {
        // return $id;
        return request()->validate(['firstname' => ['required', ['string']], 'lastname' => ['required', ['string']], 'email' => 'required|email|unique:users,email,' . $id . ',id', 'phone' => ['required', 'string', 'max:10'], 'register' => ['required', 'string', 'max:10'], 'dob' => ['required', 'date', 'max:10'], 'address' => ['required', 'string', 'max:100'], 'gender' => ['required'], 'role' => ['sometimes', 'required']
        // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        // 'tests' => 'exists:tests,id'
        ]);
    }

     // used for populate data for group dropdown
     public function fetch_groups(Request $request)
     {

         // return $request;
         $search = $request->search;
         if ($search == '')
         {
             $groups = Group::orderby('name', 'asc')->select('id', 'name')
                 ->get();
         }
         else
         {
             $groups = Group::orderby('name', 'asc')->select('id', 'name')
                 ->where('name', 'like', '%' . $search . '%')->get();
         }

         $response = array();
         foreach ($groups as $group)
         {
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
        $where = array(
            'id' => 1
        );
        $user = User::where($where)->first();
        return view('layouts.settings.participants.import', compact('user'));
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
        //  return response()->json(['msg'=>"Participant updated successfully."]);

    }

}

