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
    $img = $faker->image('public/assets/img/news', 555, 370);
    preg_match('/(\w+\.jpg)/', $img, $match);
    return [
        'title' => $faker->text(30),
        'full_text' => $faker->text(500),
        'preview_text_small' => $faker->text(150),
        'preview_text_mid' => $faker->text(300),
        'is_on_main' => mt_rand(0, 1),
        'thumbnail' => $match[0],
    ];
});


$factory->define(App\Certificate::class, function (Faker\Generator $faker) {
    $img = $faker->image('public/assets/img/certificates', 630, 891);
    preg_match('/(\w+\.jpg)/', $img, $match);
    return [
        'title' => $faker->text(30),
        'file_name' => $match[0],
    ];
});


$factory->define(App\Gallery::class, function (Faker\Generator $faker) {
    $img = $faker->image('public/assets/img/galleries', 973, 615);
    preg_match('/(\w+\.jpg)/', $img, $match);
    return [
        'file_name' => $match[0],
        'company_id' => mt_rand(1, 3),
        'title' => $faker->text(30)
    ];
});

$factory->define(App\ProductSika::class, function (Faker\Generator $faker) {
    return [
        'title'             => $faker->text(30),
        'description'       => '<p>'.$faker->text(255).'</p>',
        'package'           => '<p>'.$faker->text(30).'</p>',
        'package_list'      => '<p><strong>Упаковка:</strong> 10 л</p>',
        'characteristics'   => '<p>'.$faker->text(255).'</p>',
        'using_area'        => '<p>'.$faker->text(255).'</p>',
        'photo'             => $faker->image('public/assets/img/products/sika', 260, 370, NULL, FALSE),
        'category_id'       => 2,
        'enabled'           => TRUE,
        'tech_cart_file'    => $faker->file(base_path('resources/tech_carts'), base_path('public/assets/img/products/sika/tech-carts'), FALSE),
    ];
});
