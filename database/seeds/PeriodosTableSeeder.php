<?php

use Illuminate\Database\Seeder;

class PeriodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periodos')->insert([
            'idmateria' => App\Materia::all()->random()->id,            
            'nump' => str_random(1),]);
    }
}
