<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Part;
use Faker\Generator as Faker;

$factory->define(Part::class, function (Faker $faker) {
    return [
        'test_id'=>factory(App\Test::class),
        'num' => $faker->numberBetween(1, 100), 
        'title' => $faker->sentence, 
        'info' => $faker->sentence, 
        'start' => $faker->randomDigit, 
        'end' => $faker->randomDigit
    ];
});
