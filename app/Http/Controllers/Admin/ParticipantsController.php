<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class ParticipantsController extends Controller
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
        $users = User::paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
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

    public function store()
    {
        $data = $this->validateUser();

        $data['password'] = Hash::make($this->keyGenerator());

        $user = User::create( $data );    
        
        if($role = request('role'))
        {
            $user->assignRole($role);            
        }
        
        // $user->tests()->attach(request('tests'));

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

        return view('admin.users.edit', ['user' =>$user, 'tests' => $tests]);
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

    public function destroy(User $user)
    {
        $user->delete();

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
}
