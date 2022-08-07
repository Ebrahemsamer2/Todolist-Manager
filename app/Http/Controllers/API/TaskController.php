<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Tasks\TaskRequest;

class TaskController extends Controller
{
    public function store($id, TaskRequest $request) {
        dd( $id );
        
    }
}
