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
        'description' => $faker->sentences(5,true)
    ];
});

$factory->define(App\Lesson::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('en_US');
    return [
        'title' => $faker->catchPhrase,
        'description' => $faker->sentences(5,true),
        'content' => $faker->paragraphs(10,true),
        'subject_id' => 1,
        'teacher_id' => 1
    ];
});

$factory->define(App\Quiz::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('en_US');
    return [
        'title' => $faker->catchPhrase,
        'description' => $faker->sentences(3,true),
        'lesson_id' => 1,
        'order' => 0
    ];
});

$factory->define(App\Exam::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('en_US');
    return [
        'title' => $faker->catchPhrase,
        'description' => $faker->sentences(3,true),
        'subject_id' => 1,
        'order' => 0
    ];
});

$factory->define(App\Question::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('en_US');
    return [
        'content' => $faker->sentences(2,true),
        'score' => 1,
        'type' => 'text',
        'answer' => '',
        'exam_id' => null,
        'quiz_id' => null,
        'order' => 0,
    ];
});

$factory->define(App\Choice::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('en_US');
    return [
        'content' => $faker->catchPhrase,
        'type' => 'text',
        'question_id' => 0,
        'order' => 0,
    ];
});


$factory->define(App\Answer::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('en_US');
    return [
        'user_id' => 1,
        'question_id' => 1,
        'answer' => $faker->numerify('###'),
    ];
});

$factory->define(App\Activity::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('en_US');

    return [
        'user_id' => 1,
        'type' => 'exam-take',
        'description' => 'USER took exam : ',
        'info' => json_encode(['exam' => 1]),
        'updated_at' => $faker->dateTimeThisMonth()
    ];
});
