<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PayPeriod::class, function (Faker $faker) {
    return [
        'user_id'   =>  function () {
            return factory(App\User::class)->create()->id;
        },
        'start' => $faker->dateTime(),
        'end' => $faker->dateTime(),
        'normal_hours' => $faker->randomFloat(2,1,50),
        'overtime_hours' => $faker->randomFloat(2,1,50),
        'normal_rate' => $faker->randomFloat(2,7,100),
        'overtime_rate' => $faker->randomFloat(2,14,200),
        'gross' => $faker->randomFloat(2,100,1000),
        'tax' => $faker->randomFloat(2,10,100),
        'national_insurance' => $faker->randomFloat(2,5,50),
        'net' => $faker->randomFloat(2,100,1000),
    ];
});