<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'quiz_id'=>factory(App\Quiz::class),         
        'number'=>$faker->number,
        'type' => $faker->word,
        'answer' => $faker->sentence,        
        'image' => $faker->image
    ];
});
