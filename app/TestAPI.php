<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestAPI extends Model
{
    protected $table = 'tests';

    protected $fillable = ['id', 'category','label', 'logo', 'price_in_credits'];
}
