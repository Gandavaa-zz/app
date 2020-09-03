<?php

namespace App\Http\Controllers\Settings;

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
        $users = User::role(['admin', 'super-admin'])->paginate(10);

        return view('layouts.settings.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('layouts.settings.users.show', compact('user'));
    }

    /**
     * Create user view here
     *
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

        if($role = request('role'))
        {
            $user->assignRole($role);
        }

        // $user->tests()->attach(request('tests'));

        $request->session()->flash('message', 'Хэрэглэгчийг амжилттай бүртгэлээ!');

        // Хэрэглэгч үүссэний дараа тухайн хэрэглэгчрүү имэйл явуулна.
        return redirect('admin/users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(User $user)
    {
        $tests = Test::all();

        return view('layouts.settings.users.edit', ['user' =>$user, 'tests' => $tests]);
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

        // $user->tests()->attach(request('tests'));

        request()->session()->flash('message', 'Хэрэглэгчийг амжилттай засварлалаа!');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
    */

    public function destroy(User $user)
    {
        $user->delete();

        request()->session()->flash('message', 'Хэрэглэгчийг амжилттай устгалаа!');

        return back();
    }

    /*
    * Validation user function
    */
    public function validateUser()
    {
        return request()->validate([
            'firstname' => ['required', ['string']],
            'lastname' => ['required', ['string']],
            'phone' => ['required', ['string']],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['sometimes', 'required']
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'tests' => 'exists:tests,id'
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

        request()->session()->flash('message', 'Хэрэглэгчид амжилтай Роль өглөө!');

        return redirect()->route('users.index');
    }


}
