<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables ;

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
            $users = User::with('groups')->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '
                    <ul class="list-group list-group-horizontal list-unstyled">
                    <li class="pr-1">
                        <a href="'.route("participants.show", $row->id).'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-success btn-md" title="Харах"><i class="cil-magnifying-glass"></i></a>
                    </li>
                    <li class="pr-1">
                    <div class="btn-group">
                    <a href="" type="button" title="Бусад" class="btn btn-secondary  dropdown-toggle  btn-sm" data-toggle="dropdown">
                    <i class="cil-cog"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item edit" href="'.route("participants.edit", $row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit">Edit</a>
                        <a class="dropdown-item" href="javascript:void(0)">Assessment</a>
                        <a class="dropdown-item" href="javascript:void(0)">Add to the group</a>
                        <a class="dropdown-item delete" style="color:red;" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete">Delete</a>
                    </div>
                  </div>
                </li>
                </ul><input type="checkbox" id="'.$row->id.'"';
                    return $btn;
                })
                ->addColumn('checkbox', '<input type="checkbox" id="chkboxes" name="participant_checkbox[]" class="participant_checkbox" value="{{$id}}" />')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('layouts.settings.participants.index');
    }

    public function show($id)
    {
        $where = array('id' => $id);
        $user = User::where($where)->first();
        return view('layouts.settings.participants.show',compact('user'));
        // return response()->json($user);
    }

        // used for populate data for group dropdown
    public function fetch_groups(Request $request)
    {
        // return $request;
        $search = $request->search;
        if($search == ''){
            $groups = Group::orderby('name','asc')->select('id','name')->get();
         }else{
            $groups = Group::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->get();
         }

         $response = array();
         foreach($groups as $group){
            $response[] = array(
                 "id"=>$group->id,
                 "name"=>$group->name
            );
         }

         echo json_encode($response);
         exit;
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
        $data = $this->validateUser();

        $data['password'] = Hash::make($this->keyGenerator());
        $data['group_id'] = $request->group_id;        
        // $data['group'] = implode(',', $request->groups);        
        $data['created_by'] = auth()->id();

        $user = User::create( $data );

        if($role = request('role'))
        {
            $user->assignRole($role);
        }

        // $user->tests()->attach(request('tests'));

        $request->session()->flash('message', 'Харилцагч амжилттай бүртгэлээ!');

        return redirect()->route('participants.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(User $user,$id)
    {
        $participants = User::find($id);
        // return  $participants;
        return view('layouts.settings.participants.edit',compact('participants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        // return request();
        $data = $this->validateUser($id);

        $data = User::find($id);
        $data->firstname = $request->get('firstname');
        $data->lastname = $request->get('lastname');
        $data->email = $request->get('email');
        $data->dob = $request->get('dob');
        $data->register = $request->get('register');
        $data->phone = $request->get('phone');
        $data->gender = $request->get('gender');
        $data->address = $request->get('address');

        $data->update();
        
        return redirect()->route('participants.index')->with('success', 'Харилцагч амжилттай засварлалаа!');
    }

    /**
     * Remove the specified resource from storage.
    */

    public function destroy($id)
    {
        User::find($id)->delete();

        return response()->json(['msg'=>'Participant deleted successfully.']);
    }

    public function deleteMultiple(Request $request)
    {
        $participant_id_array = $request->input('id');
        $data = User::whereIn('id', $participant_id_array);
        if($data->delete())
        {
            return response()->json(['msg'=>'Selected Participants deleted successfully.']);
        }
    }


    /*
    * Validation user function
    */
    public function validateUser($id=null)
    {
        // return $id;
        return request()->validate([
            'firstname' => ['required', ['string']],
            'lastname' => ['required', ['string']],
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'phone' => ['required', 'string', 'max:10'],
            'register' => ['required', 'string', 'max:10'],
            'dob' => ['required', 'date', 'max:10'],
            'address' => ['required', 'string', 'max:100'],
            'gender' => ['required'],
            'role' => ['sometimes', 'required']
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'tests' => 'exists:tests,id'
        ]);

    }

    public function keyGenerator()
    {
        return Str::upper(Str::random(1)). Str::random(4) . rand(5, 10000);
    }

    public function import()
    {
        $where = array('id' => 1);
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

            if(!empty($insert_data))
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

}
