<?php

use Faker\Generator as Faker;
use Illuminate\Http\Request;


$factory->define(App\Alumno:: class, function (Faker $faker) {
    return [       
            'idcurso' => App\Curso::all()->random()->id,
            'nombre' => $faker->firstName($gender = null|'male'|'female'),
            'apaterno' => $faker->LastName,
            'amaterno' => $faker->LastName,
            'num_alumno' => str_random(10),            
            'num_ide' => str_random(10),
            'direccion' => $faker->address,
            'telefono' => $faker->tollFreePhoneNumber,
            'email' => $faker->unique()->safeEmail,
            'sexo' => str_random(1),
            'birthday' =>$faker ->date,
    ];
});
