<?php declare(strict_types=1);

namespace Database\Factories;
namespace Tests\Unit;
namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Database\Factories\TaskFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /** @test */
    public function can_create_task()
    {
        $taskData = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $response = $this->post('/tasks', $taskData);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', $taskData);

    }
    
    /** @test */
    public function can_update_task()
    {
        $task = Task::factory()->create();

        $updatedData = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $response = $this->put("/tasks/{$task->id}", $updatedData);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', $updatedData);
    }

    /** @test */
    public function can_delete_task()
    {
        $task = Task::factory()->create();

        $response = $this->delete("/tasks/{$task->id}");

        $response->assertRedirect('/tasks');
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    /** @test */
    public function task_creation_requires_title_and_description()
    {
        $response = $this->post('/tasks', []);

        $response->assertSessionHasErrors(['title', 'description']);
    }

    /** @test*/
    public function task_update_requires_title_and_description()
    {
        $task = Task::factory()->create();

        $response = $this->put("/tasks/{$task->id}", []);

        $response->assertSessionHasErrors(['title', 'description']);
    }
}
