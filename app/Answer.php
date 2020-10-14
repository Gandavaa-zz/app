<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    // protected $fillable = ['quiz_id', 'number', 'type', 'answer', 'answer_path'];
    protected $guarded  = [];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    
}
