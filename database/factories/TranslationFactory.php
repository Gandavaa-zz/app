<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'test_id'=>1,
        'EN' => $faker->sentence,
        'MN' => $faker->sentence
    ];
});
