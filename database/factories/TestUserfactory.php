<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'user_id'=>factory(App\User::class),
        'test_id'=>factory(App\Test::class),
        'completed'=>$faker->boolean(false)
    ];
});
