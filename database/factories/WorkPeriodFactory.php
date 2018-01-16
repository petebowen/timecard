<?php

use Faker\Generator as Faker;

$factory->define(App\Models\WorkPeriod::class, function (Faker $faker) {
    return [
        
    	'pay_period_id' => function () {
            return factory(App\Models\PayPeriod::class)->create()->id;
        },
        'work_date' => $faker->date(),
        'start' => $faker->time(),
        'end' => $faker->time(),
    ];
});