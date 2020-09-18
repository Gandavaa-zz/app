<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['quiz_id', 'number', 'type', 'answer', 'image'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    
}
