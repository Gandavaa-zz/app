<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tests';

    protected $fillable = ['id', 'category', 'label', 'logo', 'priority', 'price_in_credits'];
}
