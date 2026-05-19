<?php

namespace Tests\Feature\Enrollment;

use App\Models\AcademicYear;
use App\Models\Enrollment;
use App\Models\Organization;
use App\Models\Program;
use App\Models\Student;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnrollmentUniquenessTest extends TestCase
{
    use RefreshDatabase;

    public function test_duplicate_enrollment_for_same_student_program_and_year_fails(): void
    {
        $organization = Organization::factory()->create();
        $student = Student::factory()->create(['organization_id' => $organization->id]);
        $program = Program::factory()->create(['organization_id' => $organization->id]);
        $year = AcademicYear::factory()->create(['organization_id' => $organization->id]);

        Enrollment::factory()->create([
            'organization_id' => $organization->id,
            'student_id' => $student->id,
            'program_id' => $program->id,
            'academic_year_id' => $year->id,
        ]);

        $this->expectException(QueryException::class);

        Enrollment::factory()->create([
            'organization_id' => $organization->id,
            'student_id' => $student->id,
            'program_id' => $program->id,
            'academic_year_id' => $year->id,
        ]);
    }

    public function test_same_student_can_enroll_in_different_programs(): void
    {
        $organization = Organization::factory()->create();
        $student = Student::factory()->create(['organization_id' => $organization->id]);
        $programA = Program::factory()->create(['organization_id' => $organization->id]);
        $programB = Program::factory()->create(['organization_id' => $organization->id]);
        $year = AcademicYear::factory()->create(['organization_id' => $organization->id]);

        Enrollment::factory()->create([
            'organization_id' => $organization->id,
            'student_id' => $student->id,
            'program_id' => $programA->id,
            'academic_year_id' => $year->id,
        ]);

        $second = Enrollment::factory()->create([
            'organization_id' => $organization->id,
            'student_id' => $student->id,
            'program_id' => $programB->id,
            'academic_year_id' => $year->id,
        ]);

        $this->assertDatabaseCount('enrollments', 2);
        $this->assertNotNull($second->id);
    }
}
