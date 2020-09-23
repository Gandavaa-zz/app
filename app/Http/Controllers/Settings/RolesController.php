<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as Role;

class RolesController extends Controller
{

    public function index()
    {
        $roles = Role::paginate(15);

        return view('layouts.settings.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('layouts.settings.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        Role::create( $this->validateRole() );

        return redirect()->route('role.index')->with('success', 'Роль амжилттай хадгаллаа!');
    }

    public function show(Role $role)
    {
        return view('layouts.settings.roles.show', ['role' =>$role ]);
    }

    public function edit(Role $role)
    {
        return view('layouts.settings.roles.edit', ['role' =>$role ]);
    }

    public function update(Role $role)
    {
        $role->update($this->validateRole());

        return redirect()->route('role.index')-with('success', 'Роль амжилттай засагдлаа!');
    }

    public function validateRole()
    {
        return request()->validate([
            'name' => ['required', ['string']],
            'guard_name' => ['required', ['string']]
        ]);
    }

    function destroy(Role $role){

        $role->delete();
        
        return redirect()->route('role.index')->with('success', 'Роль амжилттай устгагдлаа!');
    }

    public function permission(Role $role)
    {
        $permissions = Permission::all();

        return view('layouts.settings.roles.permission', compact('role', 'permissions'));
    }

    public function givePermission(Role $role)
    {
        $permissions = request()->input('permission');

        $role->syncPermissions($permissions);

        return redirect()->route('role.index')->with('success', 'Зөвшөөрлийг амжилттай хадгаллаа!');
    }

    public function getRoles()
    {
        //get roles excerpt 
        return Role::all();
        // return Role::where('name', '!=', 'client')->get();        
    }

}
