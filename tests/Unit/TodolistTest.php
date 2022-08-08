<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_todolists_endpoint()
    {
        $response = $this->get('/');
        if( auth()->user() )
            $response->assertStatus(200);
        else
            $response->assertRedirect('/login');
    }

    public function test_storing_todolist_endpoint()
    {
        $user = \App\Models\User::create([
            'name' => 'testing',
            'email' => 'testing@yahoo.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        $token = $user->createToken('testing')->plainTextToken;
        $data = [
            'title' => 'Testing Title',
            'description' => 'Testing Description',
            'user_id' => 1
        ];

        $response = $this->actingAs($user, 'api')
        ->withHeaders(['Authorization' => 'Bearer ' . $token])
        ->json('POST', '/api/todolists', $data);

        $response->assertStatus(200);
    }

    public function test_updating_todolist_endpoint()
    {
        $user = \App\Models\User::first();
        $token = $user->createToken('testing')->plainTextToken;

        $todolist = \App\Models\Todolist::first();
        
        $update = $this->actingAs($user, 'api')
        ->withHeaders(['Authorization' => 'Bearer ' . $token, '_method' => 'PUT'])
        ->json('POST', '/api/todolists/'.$todolist->id,['title' => "Changed for test"]);

        $update->assertStatus(200);
    } 

    public function test_deleting_todolist_endpoint()
    {
        $user = \App\Models\User::first();
        $token = $user->createToken('testing')->plainTextToken;

        $todolist = \App\Models\Todolist::first();
        
        $update = $this->actingAs($user, 'api')
        ->withHeaders(['Authorization' => 'Bearer ' . $token])
        ->json('POST', "/api/todolists/$todolist->id");

        $update->assertStatus(200);
    } 

    public function test_getting_all_todolists()
    {
        $user = \App\Models\User::first();
        $token = $user->createToken('testing')->plainTextToken;

        $response = $this->actingAs($user, 'api')
        ->withHeaders(['Authorization' => 'Bearer ' . $token])
        ->json('GET', '/api/todolists');

        $response->assertStatus(200);
    }
}

