<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->word,
        'description' => $faker->text(70),
        'color' => $faker->hexColor,
        'user_id' => rand(1, 5),
    ];
});
