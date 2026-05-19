<?php

namespace Database\Factories;

use App\Models\AcademicYear;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AcademicYear>
 */
class AcademicYearFactory extends Factory
{
    protected $model = AcademicYear::class;

    public function definition(): array
    {
        return [
            'organization_id' => Organization::factory(),
            'name' => fake()->year().'-'.(fake()->year() + 1),
            'starts_on' => now()->startOfYear(),
            'ends_on' => now()->endOfYear(),
            'is_current' => true,
        ];
    }
}
