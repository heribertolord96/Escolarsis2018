<?php

use Illuminate\Database\Seeder;

class CursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cursos')->insert([
            'idcategoria' => App\Categoria::all()->random()->id,
            'nombre' => str_random(10),
            'descripcion' => str_random(40),
            
        ]);
    }
}
