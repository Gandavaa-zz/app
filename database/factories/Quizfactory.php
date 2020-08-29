<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Quiz;
use Faker\Generator as Faker;

$factory->define(Quiz::class, function (Faker $faker) {
    return [       
        'test_id'=>factory(App\Test::class),         
        'number'=>$faker->numberBetween(1, 100),
        'quiz' => $faker->sentence,
        'image' => $faker->image
    ];
});
