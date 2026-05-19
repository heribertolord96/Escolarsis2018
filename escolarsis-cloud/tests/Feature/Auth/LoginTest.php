<?php

namespace Tests\Feature\Auth;

use App\Models\Organization;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleSeeder::class);
    }

    public function test_user_can_login_via_api_with_valid_credentials(): void
    {
        $organization = Organization::factory()->create();
        $user = User::factory()->create([
            'organization_id' => $organization->id,
            'email' => 'docente@example.com',
            'password' => 'secret-pass',
        ]);
        $user->assignRole(RoleSeeder::DOCENTE);

        $response = $this->postJson('/api/v1/auth/login', [
            'email' => 'docente@example.com',
            'password' => 'secret-pass',
            'token' => true,
        ]);

        $response->assertOk()
            ->assertJsonPath('user.email', 'docente@example.com')
            ->assertJsonPath('user.roles.0', RoleSeeder::DOCENTE)
            ->assertJsonStructure(['token']);
    }

    public function test_login_rejects_invalid_credentials(): void
    {
        $organization = Organization::factory()->create();
        User::factory()->create([
            'organization_id' => $organization->id,
            'email' => 'user@example.com',
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'email' => 'user@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function test_authenticated_user_can_fetch_profile(): void
    {
        $organization = Organization::factory()->create();
        $user = User::factory()->create([
            'organization_id' => $organization->id,
        ]);
        $user->assignRole(Role::findOrCreate(RoleSeeder::ALUMNO, 'web'));

        $response = $this->actingAs($user, 'sanctum')
            ->withHeader('X-Organization-Id', (string) $organization->id)
            ->getJson('/api/v1/auth/me');

        $response->assertOk()
            ->assertJsonPath('data.email', $user->email);
    }
}
