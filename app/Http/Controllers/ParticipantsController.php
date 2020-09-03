<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Test;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use DataTables;
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
        if ($request->ajax()) {
            $data = DB::select('select tb1.id, date(tb1.created_at) as created_at, tb1.firstname, tb1.email, tb1.phone, tb3.name from users as tb1 left join group_user as tb2 on tb1.id = tb2.user_id left join groups as tb3 on tb2.id = tb3.id order by tb1.created_at desc');
            return FacadesDataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '
                    <ul class="list-group list-group-horizontal list-unstyled"><li class="pr-1">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" class="btn btn-success view btn-md">
                        <i class="cil-magnifying-glass"></i>
                        </a>
                    </li>
                    <li class="pr-1">
                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-primary btn-md" title="test"><i class="cil-user"></i></a>
                    </li>
                    <li class="pr-1">
                    <div class="btn-group">
                    <a href="" type="button" title="Бусад" class="btn btn-secondary  dropdown-toggle  btn-sm" data-toggle="dropdown">
                    <i class="cil-cog"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item edit" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit">Edit</a>
                        <a class="dropdown-item" href="javascript:void(0)">Assessment</a>
                        <a class="dropdown-item" href="javascript:void(0)">Add to the group</a>
                        <a class="dropdown-item delete" style="color:red;" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete">Delete</a>
                    </div>
                  </div>
                </li>
                </ul><input type="checkbox" id="'.$row->id.'"';
                    return $btn;
                })
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

    /**
     * Create user view here
     *
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */

    // public function store()
    // {
    //     $data = $this->validateUser();

    //     $data['password'] = Hash::make($this->keyGenerator());

    //     $user = User::create( $data );

    //     if($role = request('role'))
    //     {
    //         $user->assignRole($role);
    //     }

    //     // $user->tests()->attach(request('tests'));

    //     // Хэрэглэгч үүссэний дараа тухайн хэрэглэгчрүү имэйл явуулна.

    //     return redirect('');
    // }

    public function store(Request $request)
    {
            $data = $this->validateUser();

            $data['password'] = Hash::make($this->keyGenerator());

            $user = User::create( $data );

            if($role = request('role'))
            {
                $user->assignRole($role);
            }
                $request->session()->flash('message', 'Хэрэглэгчийг амжилттай бүртгэлээ!');
                return response()->json(['success'=>'Participant saved successfully.']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(User $user)
    {
        $user->update(request()->validate([
            'firstname' => ['required', ['string']],
            'lastname' => ['required', ['string']],
            'email' => ['required', 'string', 'email', 'max:255'],
            'tests' => 'exists:tests,id'
        ]));

        $user->tests()->attach(request('tests'));

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
    */

    public function destroy($id)
    {
        User::find($id)->delete();

        return response()->json(['success'=>'Participant deleted successfully.']);
    }

    /*
    * Validation user function
    */

    public function validateUser()
    {
        return request()->validate([
            'firstname' => ['required', ['string']],
            'lastname' => ['required', ['string']],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:10'],
            'register' => ['required', 'string', 'max:10'],
            'role' => ['sometimes', 'required']
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'tests' => 'exists:tests,id'
        ]);
    }

    public function keyGenerator()
    {
        return Str::upper(Str::random(1)). Str::random(4) . rand(5, 10000);
    }
}
