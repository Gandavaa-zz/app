<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Test;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }   
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $tests = Test::paginate(15);

        return view('layouts.settings.test.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $test_type = config('app.test_type');
        
        return view('layouts.settings.test.create', compact('test_type'));
    }

    /**
     * Store a newly created resource in storage.
     *     
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        $test_type = config('app.test_type');
        return view('admin.tests.edit', compact('test', 'test_type'));
    }

    /**
     * Update the specified resource in storage.
     * 
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        //
    }
}