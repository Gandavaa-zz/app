<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserAnswer;
use Faker\Generator as Faker;

$factory->define(UserAnswer::class, function (Faker $faker) {
    return [
        'user_id'=>factory(App\User::class),
        'quiz_id'=>factory(App\Quiz::class), 
        'answer_number'=>$faker->numberBetween(1, 100),  
    ];
});
