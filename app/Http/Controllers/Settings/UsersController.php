<?php

namespace App\Http\Controllers\Settings;

use App\Group;
use App\Http\Controllers\Controller;
use App\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

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
        $users = User::role(['admin', 'super-admin', 'writer'])->paginate(10);

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

        return view('layouts.settings.users.create', ['roles' => $roles]);
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

        // TODO: Хэрэглэгч үүссэний дараа тухайн хэрэглэгчрүү имэйл явуулна.
        return redirect()->route('users.index')->with('success', 'Хэрэглэгчийг амжилттай бүртгэлээ!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(User $user)
    {
        return view('layouts.settings.users.edit' ,
                    [
                        'user' =>$user
                    ]);
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
            'roles' => ['required', ['string']],
            'groups' => ['required', ['string']]
        ]));

        $user->syncRoles($this->rolesToArray(request('roles')));

        $user->groups()->detach();

        $user->groups()->attach($this->groupToArray(request('groups')));

        // $user->tests()->attach(request('tests'));
        return redirect()->route('users.index')->with('success', 'Хэрэглэгчийг амжилттай засварлалаа!');
    }

    /**
     * Remove the specified resource from storage.
    */

    public function destroy(User $user)
    {
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
            'roles' => ['sometimes', 'required'],
            'groups' => ['required', ['string']],
        ]);
    }

    public function keyGenerator()
    {
        return Str::upper(Str::random(1)). Str::random(4) . rand(5, 10000);
    }

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
                $group = Group::where('name', $name)->get();
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


}
