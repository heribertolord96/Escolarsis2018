<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public const ADMINISTRADOR = 'Administrador';

    public const DOCENTE = 'Docente';

    public const ALUMNO = 'Alumno';

    public function run(): void
    {
        foreach ([self::ADMINISTRADOR, self::DOCENTE, self::ALUMNO] as $role) {
            Role::findOrCreate($role, 'web');
        }
    }
}
