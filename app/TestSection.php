<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestSection extends Model
{
    public function Test()
    {
        return $this->belongsTo(Test::class);
    }
}
