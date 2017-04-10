<?php

$factory->define(App\Models\Note::class, function (Faker\Generator $faker) {

    $userId = factory(App\Models\User::class)->create()->id;

    return [
        'uid'       => str_random(32),
        'userId'    => $userId,
        'message'   => $faker->text(200),
        'tags'      => $faker->text(5)
    ];
});