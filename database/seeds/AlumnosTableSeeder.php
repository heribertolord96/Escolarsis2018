<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Faker\Factory as Faker;

class AlumnosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker :: create ('App\Alumno');
        for($i=1;$i<=5;$i++){
        DB::table('alumnos')->insert([           

            //'idcurso' => App\Curso::all()->random()->id,
            'idcurso' => 1,
            'nombre' => $faker->firstName(),
            'apaterno' => $faker->LastName,
            'amaterno' => $faker->LastName,
            'num_alumno' => str_random(10),            
            'num_ide' => str_random(10),
            'direccion' => $faker->address,
            'telefono' => $faker->tollFreePhoneNumber,
            'email' => $faker->unique->safeEmail,
            'sexo' =>  $faker-> randomElement ($array = array ('Masculino','Femenino')),
            'birthday' =>$faker ->date,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            
            'id2'=>App\Alumno::all()->unique()->random()->id, 
            'usuario'=>$faker->unique->userName,
            'password'=>"$2y$10$8xTZx.1LnBJPSarGka7Ei.jIYOuYE8KpRj/u/q4YUzParb8Tt1pZG",
            'condicion'=>"1",
            'idrol'=>"3"
            ]);
        }
        
    }
}
