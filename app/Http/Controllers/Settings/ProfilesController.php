<?php

namespace App\Http\Controllers\Settings;

use App\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{
    function show(User $user){

        $this->authorize('view', $user);

        $activities = $user->activity->fresh('subject');        

        return view('layouts.settings.users.profile', [
                'user' => $user,
                'activities' => Activity::feed($user, 50)
            ]);

    }

    public function edit(User $user)
    { 
        $this->authorize('view', $user);

        return view('layouts.settings.users.editProfile', 
                    [ 'user' => $user, 
                      'activities' => Activity::feed($user, 50)
                    ]);
    }
}
