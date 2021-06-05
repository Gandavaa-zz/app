<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';

    public function candidate(){
        return $this->belongsTo('App\Candidate');
    }


}
