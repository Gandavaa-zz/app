<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public function sections()
    {
        return $this->hasMany(TestSection::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
