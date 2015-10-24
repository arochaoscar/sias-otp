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
        'email' => strtolower ($faker->email),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role' => 'owner'
    ];
});

$factory->define(App\Aplication::class, function (Faker\Generator $faker) {
    return [
        'name' => str_random(10),
        'private_key' => bcrypt(str_random(10)),
        'public_key' => bcrypt(str_random(10)),
        'uri' => $faker->url,
        'user_id' => 2
    ];
});


$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => strtolower ($faker->email),
    ];
});