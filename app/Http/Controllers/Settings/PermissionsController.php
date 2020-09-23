<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Test;
use Illuminate\Http\Request;

class PermissionsController extends Controller
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
        $permissions = Permission::paginate(15);

        return view('layouts.settings.permissions.index', compact('permissions'));
    }


    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
        // $permissions = Permission::all();
        return view('layouts.settings.permissions.create');
        // return view('admin.permissions.create', compact('permissions'));
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store()
    {
        Permission::create( $this->validatePermission() );      
        
        return redirect()->route('permission.index')->with('success', 'Зөвшөөрөл амжилттай хадгалагдлаа!');
    }

    /**
     * Permission the specified permission.    
     */
    public function validatePermission()
    {
        return request()->validate([
            'name' => ['required', ['string']],
            'guard_name' => ['required', ['string']]
        ]);     
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function show(Permission $permission)
    {   
        return view('layouts.settings.permissions.show', ['permission' =>$permission]);
    }


    public function edit(Permission $permission)
    {
        return view('layouts.settings.permissions.edit', ['permission' =>$permission]);
    }

    /**
     * Update the specified resource in storage.
    */

    public function update(Permission $permission)
    {
        $permission->update($this->validatePermission());

        return redirect()->route('permission.index')->with('success', 'Зөвшөөрөл амжилттай шинэчлэгдлээ!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        
        return redirect()->route('permission.index')->with('success', 'Зөвшөөрөл амжилттай устгагдлаа!');
    }

    public function getPermissions()
    {
        $permissions = Permission::all();
        return $permissions;
    }
}
