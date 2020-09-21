<?php

use Illuminate\Database\Seeder;

class MateriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materias')->insert([
            'idcurso' => App\Curso::all()->random()->id,
            'idpersona' => App\Persona::all()->random()->id,
            'nombre' => str_random(10),
            'descripcion' => str_random(40),]);
    }
}
