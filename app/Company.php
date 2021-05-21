<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'company';

    public function participants(){
        return $this->hasMany('App\Participant');
    }


}
