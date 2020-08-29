<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Test;
use Faker\Generator as Faker;

$factory->define(Test::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'info'=>$faker->sentence, 
        'type'=>$faker->word,
        'duration'=>$faker->unixTime
    ];
});
