<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 class Group_User extends Model
{

    protected $table = 'group_user';
    protected $fillable = [
        'group_id', 'user_id'
    ];


    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

}
