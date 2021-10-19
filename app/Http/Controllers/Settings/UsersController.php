<?php

namespace App\Http\Controllers\Settings;
use App\Company;
use App\Group;
use App\Http\Controllers\Controller;
use App\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/*
     Users has roles with admin | super-admin | writer | its system users
*/
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::role(['admin', 'super-admin', 'writer', 'analyst'])->paginate(10);

        return view('layouts.settings.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return $user->activity->fresh('subject');

        return view('layouts.settings.users.show', compact('user'));
    }

    /**
     * Create user view here
     */
    public function create()
    {
        $roles = Role::all();
        $companies  = Company::all();

        return view('layouts.settings.users.create', ['roles' => $roles, 'companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $data = $this->validateUser();
        $data['password'] = Hash::make($this->keyGenerator());
        $user = User::create( $data );
        $user->assignRole($this->rolesToArray(request('roles')));
        $user->groups()->attach($this->groupToArray(request('groups')));
        
        return redirect()->route('users.index')->with('success', 'Хэрэглэгчийг амжилттай бүртгэлээ!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(User $user)
    {
        // return $user;
        return view('layouts.settings.users.edit', ['user' =>$user]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(User $user, Request $request)
    {

        $user->update(request()->validate([
            'firstname' => ['required', ['string']],
            'lastname' => ['required', ['string']],
            'email' => ['required', 'string', 'email', 'max:255'],
            'roles' => ['required', ['string']]           
        ]));

        if($request->hasfile('filename')){            
            $user->avatar_path = $request->filename->store('filename', 'public');
        }
        
        $user->syncRoles($this->rolesToArray(request('roles')));

        $user->groups()->detach();

        $user->groups()->attach($this->groupToArray(request('groups')));

        // $user->tests()->attach(request('tests'));
        // password update
        if($request->changePassword && $request->changePassword ==1){
            $request->validate([
                'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('Оруулсан нууц үг Одоогийн нууц үгтэй тохирохгүй байна.');
                    }
                }],
                'new_password' => ['required'],
                'new_confirm_password' => ['required', ['same:new_password']],
            ]);

            $user->update(['password'=> Hash::make($request->new_password)]);
        }
        
        return redirect()->route('users.index')->with('success', 'Хэрэглэгчийг амжилттай засварлалаа!');
    }

    /**
     * Remove the specified resource from storage.
    */

    public function destroy(User $user)
    {
        
        if($user->hasRole('super-admin'))
            return back()->with('success', 'Super admin эрхтэй хэрэглэгчийг устгах боломжгүй!');
        else 
            $user->delete();
        return back()->with('success', 'Хэрэглэгчийг амжилттай устгалаа!');

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
            'roles' => ['sometimes', 'required']
            // 'groups' => ['required', ['string']],
        ]);
    }

    public function keyGenerator()
    {
        return Str::upper(Str::random(1)). Str::random(4) . rand(5, 10000);
    }

    /* Return User roles */

    public function roles(User $user)
    {
        return view('layouts.settings.users.roles', ['user' =>$user]);
    }

    public function giveRoles(User $user)
    {
        $user->assignRole(request('role'));

        return redirect()->route('users.index')->with('success', 'Хэрэглэгчид амжилтай Роль өглөө!');
    }

    protected function rolesToArray($roles){

        foreach(explode(",", $roles) as $role)
        {
            $role_array[] =  $role;
        }

        return $role_array;
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

    function profile(User $user){

        return view('layouts.settings.users.profile', compact('user'));

    }

    function getGroups(){

        // TODO хэрвээ user-ng role: admin|super-admin байвал
        $group_id = config('app.admin_group');

        $groups =  Group::all();

        if (response()->json()){
            return $groups;
        }
    }

    /*
    * cdc.users-n мэдээллийг import Хийж ороуулах
    * aauth user рольтой хэрэглэгчидийг import хийх хэрэгтэй
    */
    function import(){


    }


}
