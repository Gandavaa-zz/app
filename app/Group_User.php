<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_User extends Model
{
    protected $fillable = [
        'group_id', 'user_id'
    ];
}
