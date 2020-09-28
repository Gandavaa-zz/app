<?php

namespace App\Http\Controllers\Settings;

use App\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{
    function show(User $user){

        // return  Activity::feed($user, 50);

         $activities = $user->activity->fresh('subject');        

        return view('layouts.settings.users.profile', [
                'user' => $user,
                'activities' => Activity::feed($user, 50)
            ]);

    }
}
