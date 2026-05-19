<?php

namespace Database\Factories;

use App\Models\AcademicYear;
use App\Models\Enrollment;
use App\Models\Program;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enrollment>
 */
class EnrollmentFactory extends Factory
{
    protected $model = Enrollment::class;

    public function definition(): array
    {
        return [
            'organization_id' => null,
            'student_id' => Student::factory(),
            'program_id' => Program::factory(),
            'academic_year_id' => AcademicYear::factory(),
            'status' => 'active',
            'enrolled_on' => now()->toDateString(),
        ];
    }
}
