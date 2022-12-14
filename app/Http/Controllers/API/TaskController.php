<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Tasks\TaskRequest;
use App\Http\Requests\Tasks\TaskUpdateRequest;
use App\Http\Resources\TaskResource;

use App\Models\{Todolist, Task};

class TaskController extends Controller
{
    public function store(Todolist $todolist, TaskRequest $request) {
        return response()->json([
            'task' => new TaskResource(Task::add( $todolist, $request ))
        ]);
    }

    public function update(Todolist $todolist, $task, TaskUpdateRequest $request) {
        
        return response()->json([
            'success' => Task::modify( $todolist, $task, $request)
        ]);
    }

    public function destroy(Todolist $todolist, $task) {
        return response()->json([
            'success' => Task::remove( $todolist, $task )
        ]);
    }
}
