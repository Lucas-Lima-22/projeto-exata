<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    public function test_redirect_for_unauthenticated_user(): void
    {
        $response = $this->get('/');
        $response->assertFound();

        $response = $this->get('/tasks/create');
        $response->assertFound();

        $response = $this->post('/tasks');
        $response->assertFound();

        $task = Task::factory()->create([
            "user_id" => User::inRandomOrder()->first()->id
        ]);

        $response = $this->get('/tasks/' . $task->id);
        $response->assertForbidden();

        $response = $this->get('/tasks/' . $task->id . '/edit');
        $response->assertForbidden();

        $response = $this->put('/tasks/' . $task->id);
        $response->assertForbidden();

        $response = $this->delete('/tasks/' . $task->id);
        $response->assertForbidden();
    }
}
