<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{   
    use RecordsActivity;
    
    protected $fillable = [
        'test_id', 'number', 'quiz', 'quiz_path'
    ];

    protected $withCount = [ 'answers' ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function counts(){
        
        return $this->get()->count();
    }
}
