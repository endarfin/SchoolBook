<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(\App\Models\News::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3, 8), true);
    $txt = $faker->realText(rand(1000, 4000));
    $isPublished = rand(1, 5) > 1;
    $img = rand(1, 3) > 1 ? 'uploads/55WTUR53v205yLlIxN2m3rBKsBexZTEcUsGguraM.jpeg' : null;

    $data = [
        'categories_id' =>rand(1, 10),
        'user_id' => rand(1, 5),
        'title' => $title,
        'img' => $img,
        'slug' => str::slug($title),
        'excerpt' => $faker->text(rand(40, 100)),
        'content' => $txt,
        'is_published' => $isPublished,
        'published_ad' => $isPublished ? $faker->dateTimeBetween('-2 months', '-1 days') : null,
    ];

    return $data;
});
