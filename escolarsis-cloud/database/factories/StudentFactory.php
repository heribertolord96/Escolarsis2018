<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'organization_id' => null,
            'person_id' => Person::factory(),
            'student_code' => fake()->unique()->numerify('STU####'),
            'is_active' => true,
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (Student $student): void {
            if ($student->person && ! $student->organization_id) {
                $student->organization_id = $student->person->organization_id;
            }
        });
    }
}
