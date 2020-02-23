<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Alumno;
use Faker\Factory;

$faker = Factory::create("es_ES");

$factory->define(Alumno::class, function ($faker) {
    return [
        "nombre" => $faker -> firstName ($gender = "male"|"female" ),
        "apellidos" => $faker->lastName,
        "mail"=>$faker->unique()->email
    ];
});
