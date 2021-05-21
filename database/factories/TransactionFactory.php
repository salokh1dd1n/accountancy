<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'date' => $faker->date('Y-m-d'),
//        'amount' => $faker->randomNumber(rand(1, 6)).'000',
        'amount' => $faker->randomFloat(rand(1, 6)),
        'is_income' => rand(0, 1),
        'description' => $faker->text(250),
        'category_id' => rand(1, 30),
        'user_id' => rand(1, 5),
    ];
});
