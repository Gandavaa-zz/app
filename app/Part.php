<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $guarded = [];

    function test()
    {
        return $this->belongsTo(Test::class);
    }
}
