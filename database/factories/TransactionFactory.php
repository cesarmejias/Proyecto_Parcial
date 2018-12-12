<?php

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
    	'user_id'   => App\User::all()->random()->id,
    	'category_id' => App\Category::all()->random()->id,
    	'amount'    => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
    	'state'  => $faker->randomElement(['RETIRO','DEPOSITO']),
    	'created_at' => $faker->dateTimeThisDecade(),
    ];
});