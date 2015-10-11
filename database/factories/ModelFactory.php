<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\News::class, function (Faker\Generator $faker) {
    $img = $faker->image('public/assets/img/news', 370, 247);
    return [
        'title' => $faker->text(40),
        'full_text' => $faker->text(500),
        'preview_text_small' => $faker->paragraph(),
        'preview_text_mid' => $faker->text(300),
        'thumbnail' => str_replace('public/assets/img/news/', '', $img),
    ];
});
