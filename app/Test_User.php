<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test_User extends Model
{
    protected $table = 'user_test';

    public function candidate()
    {
        return $this->belongsToMany('App\Candidate');
    }

}
