<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Organization;
use App\Models\Program;
use App\Models\User;
use Database\Seeders\RoleSeeder as Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        $organization = Organization::query()->firstOrCreate(
            ['slug' => 'demo'],
            [
                'name' => 'Escuela Demo',
                'institution_type' => 'diplomado',
                'settings' => ['locale' => 'es'],
                'is_active' => true,
            ]
        );

        $academicYear = AcademicYear::query()->firstOrCreate(
            [
                'organization_id' => $organization->id,
                'name' => '2025-2026',
            ],
            [
                'starts_on' => '2025-08-01',
                'ends_on' => '2026-07-31',
                'is_current' => true,
            ]
        );

        Program::query()->firstOrCreate(
            [
                'organization_id' => $organization->id,
                'code' => 'GEN',
            ],
            [
                'name' => 'Programa general',
                'level' => 'course',
                'is_active' => true,
            ]
        );

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@escolarsis.test'],
            [
                'organization_id' => $organization->id,
                'name' => 'Administrador Demo',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );

        $admin->assignRole(Roles::ADMINISTRADOR);

        unset($academicYear);
    }
}
