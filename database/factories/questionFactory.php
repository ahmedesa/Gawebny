<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'title' => $faker->text(10),
        'body' => $faker->text(100),
        'user_id' => $faker->numberBetween($min = 0, $max = 1),
            ];
});
