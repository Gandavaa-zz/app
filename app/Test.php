<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use RecordsActivity;
    
    protected $fillable = ['title','info', 'type', 'duration'];

    protected $withCount = [ 'quizzes' ];

    public function sections()
    {
        return $this->hasMany(TestSection::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function parts()
    {
        return $this->hasMany(Part::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }




}
