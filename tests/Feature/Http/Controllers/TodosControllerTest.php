<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodosControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     * @return void
     */
    public function test_can_get_all_todo_items()
    {
        $todo = Todo::factory()->create();
        $response = $this->get('/api/todos');
        $response->assertSee($todo->content);
        $response->assertOk();
    }

    public function test_can_create_new_todo_item()
    {
        $content = 'Buy mineral water';
        $response = $this->post('/api/todos', [
            'new_content' => $content
        ]);
        $response->assertOk();
        $this->assertDatabaseCount('todos', 1);
//        $response->assertJsonFragment([
//            'status' => 'success'
//        ]);
    }

    public function test_can_update_todo_item()
    {
        $todo = Todo::factory()->create();

        $response = $this->putJson('/api/todos/' . $todo->id, [
            'is_done' => !$todo->is_done
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'is_done' => !$todo->is_done
        ]);
    }

    public function test_can_delete_todo_item()
    {
        $todo = Todo::factory()->create();

        $response = $this->delete('/api/todos/' . $todo->id);
        $response->assertOk();
        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id
        ]);
    }
}
