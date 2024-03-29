<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'admin' => 0, 
        'utr'=> str_random(10), 
        'tax_code' => '1100L',
        'normal_rate' => $faker->randomFloat(2,8,50),
        'overtime_rate' => $faker->randomFloat(2,8,50),
        'contracted_hours' => $faker->numberBetween(4,37),
        'total_hours' => 0,
        'total_pay' => 0,
    ];
});
