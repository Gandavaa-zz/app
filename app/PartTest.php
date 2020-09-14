<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartTest extends Model
{
    protected $guarded = [];
    protected $table = 'part_test';
    
    function test()
    {
        return $this->belongsTo(Test::class);
    }
}
