<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{
    function show(User $user){

        return view('layouts.settings.users.profile', compact('user'));

    }
}
