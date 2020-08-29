<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public function Test()
    {
        return $this->belongsTo(Test::class);
    }
    
    public function Answer()
    {
        return $this->hasMany(Answer::class);
    }
}
