<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->catchPhrase,
        'author' => $faker->name,
        'year' => $faker->year($max = 'now'),
        'isbn' => $faker->unique()->isbn13,
        'price' => $faker->randomFloat(2, 5, 100)
    ];
});
