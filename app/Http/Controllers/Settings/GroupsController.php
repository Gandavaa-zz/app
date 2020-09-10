<?php

namespace App\Http\Controllers\Settings;

use App\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::paginate(10);
        return view('layouts.settings.group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *     
     */
    public function create()
    {
        return view('layouts.settings.group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $data = $this->validateGroup();

        $group = Group::create( $data );

        $request->session()->flash('message', 'Хэрэглэгчийг амжилттай бүртгэлээ!');

        return redirect()->route('group.index');

    }

    /**
     * Display the specified resource.
     *     
     */
    public function show(Group $group)
    {
        return view('layouts.settings.group.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *     
     */
    public function edit(Group $group)
    {
        return view('layouts.settings.group.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *     
     */
    public function update(Group $group)
    {
        $group->update($this->validateGroup());
        
        request()->session()->flash('message', 'Группын мэдээллийг амжилттай засварлалаа!');

        return redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Group $group)
    {
        $group->delete();

        request()->session()->flash('message', 'Группын мэдээллийг амжилттай устгалаа!');

        return redirect()->route('group.index');

    }

    public function validateGroup()
    {
        return request()->validate([
            'name' => ['required', ['string']]            
        ]);
    }
    
}
