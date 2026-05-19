<?php

namespace Tests\Feature\Tenant;

use App\Models\Organization;
use App\Models\Student;
use App\Services\OrganizationContext;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrganizationScopeTest extends TestCase
{
    use RefreshDatabase;

    public function test_global_scope_filters_records_by_current_organization(): void
    {
        $orgA = Organization::factory()->create(['name' => 'Org A']);
        $orgB = Organization::factory()->create(['name' => 'Org B']);

        $studentA = Student::factory()->create(['organization_id' => $orgA->id]);
        Student::factory()->create(['organization_id' => $orgB->id]);

        app(OrganizationContext::class)->setById($orgA->id);

        $visible = Student::query()->pluck('id')->all();

        $this->assertSame([$studentA->id], $visible);
    }

    public function test_without_organization_context_all_tenant_rows_are_visible(): void
    {
        Organization::factory()->count(2)->create();
        Student::factory()->count(3)->create();

        app(OrganizationContext::class)->set(null);

        $this->assertCount(3, Student::withoutGlobalScopes()->get());
        $this->assertCount(3, Student::query()->get());
    }
}
