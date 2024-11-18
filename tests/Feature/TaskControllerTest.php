<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    public function test_restricted_access_to_admins()
    {
        $admin = User::factory()->create(['profile' => 'admin']);
        $guest = User::factory()->create(['profile' => 'guest']);

        $this->actingAs($admin)->get('/admin')->assertOk();
        $this->actingAs($guest)->get('/admin')->assertForbidden();
    }

    public function test_admins_can_view_create_edit_update_and_delete_any_tasks()
    {
        $admin = User::factory()->create(['profile' => 'admin']);
        $randomTask = Task::factory()->create(['user_id' => User::inRandomOrder()->first()->id]);

        $this->actingAs($admin)->get('/admin')->assertSee($randomTask->id);

        $this->actingAs($admin)->get('/tasks/create')->assertOk();

        $data = [
            'title'       => 'new task title.',
            'description' => 'new task description.',
            'status'      => 'pending'
        ];

        $this->actingAs($admin)->post('/tasks', $data);
        $this->assertDatabaseHas('tasks', $data);

        $this->actingAs($admin)->get('/tasks/' . $randomTask->id)->assertOk();

        $this->actingAs($admin)->get('/tasks/' . $randomTask->id . '/edit')->assertOk();

        $data = [
            'title'       => 'updated task title.',
            'description' => 'updated task description.',
            'status'      => 'pending'
        ];

        $this->actingAs($admin)->put('/tasks/' . $randomTask->id, $data);
        $this->assertDatabaseHas('tasks', $data);

        $this->actingAs($admin)->delete('/tasks/' . $randomTask->id);
        $this->assertDatabaseMissing('tasks', ['id' => $randomTask->id]);
    }

    public function test_unauthorized_users_cannot_view_edit_update_or_delete_tasks_from_other_users()
    {
        $task = Task::factory()->create(['user_id' => User::inRandomOrder()->first()->id]);

        $unauthorizedUser = User::factory()->create(['profile' => 'guest']);

        $this->actingAs($unauthorizedUser)->get('/')->assertDontSee($task->id);

        $this->actingAs($unauthorizedUser)->get('/tasks/' . $task->id)->assertForbidden();

        $this->actingAs($unauthorizedUser)->get('/tasks/' . $task->id . '/edit')->assertForbidden();

        $this->actingAs($unauthorizedUser)->put('/tasks/' . $task->id, [
            'title'       => 'updated task title.',
            'description' => 'updated task description.',
            'status'      => 'in-progress'
        ])->assertForbidden();

        $this->actingAs($unauthorizedUser)->delete('/tasks/' . $task->id)->assertForbidden();
    }

    public function test_authenticated_users_can_view_create_edit_update_and_delete_own_tasks()
    {
        $user = User::factory()->create(['profile' => 'guest']);
        $task = Task::factory()->create(['user_id' => $user]);

        $this->actingAs($user)->get('/')->assertSee($task->id);

        $this->actingAs($user)->get('/tasks/create')->assertOk();

        $data = [
            'title'       => 'new task title.',
            'description' => 'new task description.',
            'status'      => 'pending'
        ];

        $this->actingAs($user)->post('/tasks', $data);
        $this->assertDatabaseHas('tasks', $data);

        $this->actingAs($user)->get('/tasks/' . $task->id)->assertOk();

        $this->actingAs($user)->get('/tasks/' . $task->id . '/edit')->assertOk();

        $data = [
            'title'       => 'updated task title.',
            'description' => 'updated task description.',
            'status'      => 'pending'
        ];

        $this->actingAs($user)->put('/tasks/' . $task->id, $data);
        $this->assertDatabaseHas('tasks', $data);

        $this->actingAs($user)->delete('/tasks/' . $task->id);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
