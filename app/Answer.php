<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
