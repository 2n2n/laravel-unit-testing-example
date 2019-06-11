<?php

use Faker\Generator as Faker;
use App\Models\Event;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'description' => $faker->paragraphs(),
    ];
});
