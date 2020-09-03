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
        $role= Role::create( $this->validateRole() );   
        
        $request->session()->flash('message', 'Роль амжилттай хадгаллаа!');      
        // $permission = Permission::find(request('permission'));
        // $role->save();
        return redirect()->route('role.index');
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

        request()->session()->flash('message', 'Роль амжилттай засагдлаа!');      
        
        return redirect()->route('role.index');
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
        request()->session()->flash('message', 'Роль амжилттай устгагдлаа!');      
        return redirect()->route('role.index');
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
        // $role->givePermissionTo($permission);        
        request()->session()->flash('message', 'Зөвшөөрлийг амжилттай хадгаллаа!');      
        
        return redirect()->route('role.index');
    }

}
