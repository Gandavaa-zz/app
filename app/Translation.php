<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $guarded  = [];

    public function test(){
        return $this->belongsTo('App\Test');
    }
}
