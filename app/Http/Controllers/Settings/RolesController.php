<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        Role::create($this->validateRole());

        return redirect()->route('role.index')->with('success', 'Роль амжилттай хадгаллаа!');
    }

    public function show(Role $role)
    {
        return view('layouts.settings.roles.show', ['role' => $role]);
    }

    public function edit(Role $role)
    {
        return view('layouts.settings.roles.edit', ['role' => $role]);
    }

    public function update(Role $role)
    {
        $role->update($this->validateRole());

        return redirect()->route('role.index')->with('success', 'Роль амжилттай засагдлаа!');
    }

    public function validateRole()
    {
        return request()->validate([
            'name' => ['required', ['string']],
            // 'guard_name' => ['required', ['string']],
        ]);
    }

    public function destroy(Role $role)
    {
        if($role=='super-admin')
            return back()->with('success', 'Super admin эрхийг устгах боломжгүй!');        
        else 
            $role->delete();

        return redirect()->route('role.index')->with('success', 'Роль амжилттай устгагдлаа!');
    }

    public function permission(Role $role)
    {
        $permissions = Permission::all();

        $permission_ids = array();
        $perm_names = array();

        if ($permissions) {
            foreach ($permissions as $permission) {
                array_push($permission_ids, $permission->id);
                array_push($perm_names, $permission->name);
            }
            $permission_names = Permission::whereIn('id', $permission_ids)->get();
        }
        $strings = implode(', ', $perm_names);
        return view('layouts.settings.roles.permission', compact('role', 'permission_names', 'permissions', 'strings'));
    }

    public function givePermission(Role $role)
    {

        // return request();

        request()->validate([
            'name' => ['required'],
            'permissions' => ['required', ['string']],           
        ]);

        $permIds = $this->getPermissionId(request()->input('permissions'));

        $role->syncPermissions($permIds);

        return redirect()->route('role.index')->with('success', 'Зөвшөөрлийг амжилттай хадгаллаа!');
    }

    public function getRoles()
    {
        //get roles excerpt
        return Role::all();
        // return Role::where('name', '!=', 'client')->get();
    }

    public function rolePermission(Request $request)
    {

        $permission = $request->data;

        if ($permission == '') {
            $permissions = Permission::orderby('name', 'asc')->select('id', 'name')
                ->get();
        } else {
            $strings = implode(', ', $permission);
            $permissions = Permission::orderby('name', 'asc')->select('id', 'name')
                ->whereIn('name', $permission)->get();
        }

        //  $response = array();

        foreach ($permissions as $perm) {
            $response[] = array(
                "name" => $perm->name,
            );
        }
        echo json_encode($response);
        exit;
    }

    protected function getPermissionId($permissions){

        if(Str::contains($permissions, ',')){

            foreach(explode(",", $permissions) as $name)
            {
                $permission = Permission::where('name', $name)->first();

                $ids[] = $permission->id;
            }
        }else{
            $permission = Permission::where('name', $permissions)->first();

            $ids[] = $permission->id;

        }

        return $ids;
    }

}
