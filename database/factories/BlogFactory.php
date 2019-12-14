<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'subject' => $faker->title,
        'content' => $faker->text,
        'created_at' =>now(),
        'updated_at' =>now(),
    ];
});
