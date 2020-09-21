<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AlumnosTableSeeder::class);
        $this->call(CursosTableSeeder::class);
        $this->call(MateriasTableSeeder::class);
        $this->call(PeriodosTableSeeder::class);
        $this->call(SesionsTableSeeder::class);
    }
}
