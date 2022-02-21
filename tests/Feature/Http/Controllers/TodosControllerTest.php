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
    public function test_index()
    {
        $todo = Todo::factory()->create();
        $response = $this->get('/api/todos');
        $response->assertSee($todo->content);
        $response->assertOk();
    }
}
