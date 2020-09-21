<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SesionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker :: create ('App\Sesion');
        for($i=1;$i<=10;$i++){
           
            DB::table('sesions')->insert([  
            // 'idmateria' => App\Materia::id() =>1,
            'idmateria' => '1',   //1   8      
            'idalumno' => App\Alumno::all()->random()->id,
            //'idperiodo' => App\Periodo::all()->rand(1)->id,
            'idperiodo' =>'2',//2 6
            'fecha' =>$faker ->date,
            //'fecha' =>'10-23-2018',
            'calificacion'=>$faker ->numberBetween($min = 50, $max = 100),
            'asistencia'=>$faker-> randomElement ($array = array ('1','0')),
            'conducta'=>$faker ->numberBetween($min = 50, $max = 100),
            ]);
        }
    }
}
