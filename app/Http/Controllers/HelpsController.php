<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HelpsController extends Controller
{
    /**
     * Display a settings help.
     *
     */
    public function settings()
    {        
        return view('layouts.helps.settings');
    }

    /**
     * Display participants
     *     
     */
    public function participants()
    {
        return view('layouts.helps.participants');
    }

    /**
     * Display help test
     *     
     */
    public function tests()
    {
        return view('layouts.helps.tests');
    }

    /**
     * Display the specified resource.
     *     
     */
    public function translation()
    {
        return view('layouts.helps.translation');
    }

}
