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
    $faker = Faker\Factory::create('en_US');
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Subject::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('en_US');
    return [
        'title' => $faker->text(15,true),
        'description' => $faker->paragraphs(5,true)
    ];
});

$factory->define(App\Lesson::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('en_US');
    return [
        'title' => $faker->catchPhrase,
        'description' => $faker->paragraphs(10,true),
        'content' => $faker->paragraphs(10,true),
        'subject_id' => 1,
        'teacher_id' => 1
    ];
});
