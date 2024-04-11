<?php declare(strict_types=1);

namespace Database\Factories;
namespace Tests\Unit;
namespace Tests\Feature;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_register_user()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        $response = $this->post('/register', $userData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }

    /** @test */
    public function can_login_user_with_correct_credentials()
    {
        $user = User::factory()->create([
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
        ]);

        $credentials = [
            'email' => 'jane@example.com',
            'password' => 'password123',
        ];

        $response = $this->post('/login', $credentials);

        $response->assertRedirect('/tasks');
        $this->assertAuthenticatedAs($user);
    }
}




