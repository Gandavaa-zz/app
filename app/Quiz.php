<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'test_id', 'number', 'quiz'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
