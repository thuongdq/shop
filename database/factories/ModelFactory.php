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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'avatar' => '',
        'phone' => $faker->phoneNumber,
        'interests' => $faker->realText(50),
        'occupation' =>$faker->jobTitle,
        'about' => $faker->realText(150),
        'website' =>$faker->url,
        'address' => $faker->address
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'slug' => str_slug($name),
        'order' => rand(-100, 100),
        'parent' => 0
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'user_id' => rand(1, 50),
        'name' => $faker->name,
        'address' => $faker->text(80),
        'email' => $faker->email,
        'phone' => $faker->phoneNumber
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'slug' => str_slug($name)
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    $code = strtoupper(str_random(6));
    return [
        'name' => $name,
        'code' => $code,
        'slug' => str_slug($name.'-'.$code),
        'content' => $faker->text,
        'regular_price' => rand(20000001, 30000000),
        'sale_price' => rand(10000001, 20000000),
        'original_price' => rand(1, 1000),
        'quantity' => rand(1, 100),
        'attributes' => '',
        'image' => '',
        'user_id' => rand(1, 50),
        'status' => rand(0, 2),
        'views' => rand(0, 500),
        'category_id' => !in_array($category = rand(1,21), [2,7,12,6]) ? $category : 1,
        'meta_title' => $name,
        'meta_keywords' => $faker->text,
        'meta_description' => $faker->text
    ];
});

$factory->define(App\News::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'title' => $name,
        'slug' => str_slug($name.'-'.time()),
        'sumary' => $faker->realText(150),
        'content' => $faker->text,
        'image' => $faker->imageUrl(246,186),
        'user_id' => rand(1, 50),
        'status' => rand(0, 2),
        'views' => rand(0, 500),
        'category_id' => !in_array($category = rand(1,21), [2,7,12,6]) ? $category : 1,
        'meta_title' => $name,
        'meta_keywords' => $faker->text,
        'meta_description' => $faker->text
    ];
});
