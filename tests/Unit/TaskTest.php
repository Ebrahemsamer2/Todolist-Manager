<?php

namespace Tests\Unit;

use Tests\TestCase;

class TaskTest extends TestCase
{
    
    public function test_storing_task_endpoint()
    {
        $user = \App\Models\User::create([
            'name' => 'testing',
            'email' => 'testing2@yahoo.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        $token = $user->createToken('testing')->plainTextToken;

        $todolist = \App\Models\Todolist::create([
            'title' => 'testing testing',
            'description' => 'testing testing',
            'user_id' => $user->id
        ]);

        $data = [
            'title' => 'Testing Task Title',
            'todolist_id' => $todolist->id
        ];

        $response = $this->actingAs($user, 'api')
        ->withHeaders(['Authorization' => 'Bearer ' . $token])
        ->json('POST', "/api/list/$todolist->id/tasks", $data);

        $response->assertStatus(200);
    }

    public function test_updating_task_endpoint()
    {
        $user = \App\Models\User::first();
        $token = $user->createToken('testing')->plainTextToken;

        $task = \App\Models\Task::first();
        
        $update = $this->actingAs($user, 'api')
        ->withHeaders(['Authorization' => 'Bearer ' . $token])
        ->json('PUT', "/api/list/$task->todolist_id/tasks/$task->id",['title' => "Changed for test"]);

        $update->assertStatus(200);
    }

    public function test_deleting_task_endpoint()
    {
        $user = \App\Models\User::first();
        $token = $user->createToken('testing')->plainTextToken;

        $task = \App\Models\Task::first();
        
        $update = $this->actingAs($user, 'api')
        ->withHeaders(['Authorization' => 'Bearer ' . $token])
        ->json('DELETE', "/api/list/$task->todolist_id/tasks/$task->id");

        $update->assertStatus(200);
    } 

    public function test_getting_all_tasks_in_todolist()
    {
        $user = \App\Models\User::first();
        $token = $user->createToken('testing')->plainTextToken;

        $todolist = \App\Models\Todolist::first();

        $response = $this->actingAs($user, 'api')
        ->withHeaders(['Authorization' => 'Bearer ' . $token])
        ->json('GET', "/api/todolists/$todolist->id");

        $response->assertStatus(200);
    }
}
