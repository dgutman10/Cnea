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
        'name'              => $faker->name,
        'email'             => $faker->unique()->email,
        'password'          => 'secret',
        'telephone'         => $faker->phoneNumber,
        'doc_number'        => rand(10000000, 30000000),
        'role'              => $faker->randomElement(['admin','profesor','alumno']),
        'remember_token'    => str_random(10),
    ];
});

$factory->define(\App\Tag::class, function (Faker\Generator $faker) {
    return [
        'nombre' => $faker->unique()->slug($nbWords = 2),
    ];
});

$factory->define(\App\Instrumento::class, function (Faker\Generator $faker) {
    return [
        'nombre'        => $faker->unique()->colorName,
        'inventario'    => $faker->numberBetween($min = 1000, $max = 10000),
        'img_url'       => $faker->imageUrl(),
        'descripcion'   => $faker->text($maxNbChars = 1000),
        'observaciones' => $faker->text($maxNbChars = 140),
        'estado_prestamo' => $faker->randomElement(['prestado','disponible']),
    ];
});

$factory->define(\App\Laboratorio::class, function (Faker\Generator $faker) {
    return [
        'nombre'    => $faker->streetName,
        'tipo'      => $faker->randomElement(['externo','interno']),
    ];
});

$factory->define(\App\Curso::class, function (Faker\Generator $faker) {
    return [
        'nombre'    => $faker->unique()->monthName,
    ];
});

$factory->define(\App\Instructivo::class, function (Faker\Generator $faker) {
    return [
        'nombre'    => $faker->unique()->lastName,
        'url'       => $faker->unique()->url,
    ];
});

$factory->define(\App\Prestamo::class, function (Faker\Generator $faker) {
    return [
        'usuario_presta'            => $faker->numberBetween($min = 1, $max = 20),
        'usuario_recibe'            => $faker->numberBetween($min = 1, $max = 20),
        'laboratorio_id'    => $faker->numberBetween($min = 1, $max = 12),
        'curso_id'          => $faker->numberBetween($min = 1, $max = 12),
        'instrumento_id'    => $faker->numberBetween($min = 1, $max = 50),
        'estado_prestamo'            => $faker->randomElement(['abierto','terminado']),
        'mail'              => $faker->email,
        'telefono'          => $faker->phoneNumber,
    ];
});

$factory->define(\App\InstrumentoTag::class, function (Faker\Generator $faker) {
    return [
        'instrumento_id' => $faker->numberBetween($min = 1, $max=20),
        'tag_id' => $faker->numberBetween($min = 1, $max=20),
    ];
});

$factory->define(\App\CursoUsuario::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max=20),
        'curso_id' => $faker->numberBetween($min = 1, $max=12),
    ];
});

$factory->define(\App\LaboratorioUsuario::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max=20),
        'laboratorio_id' => $faker->numberBetween($min = 1, $max=20),
    ];
});
