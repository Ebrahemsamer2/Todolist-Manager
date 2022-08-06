<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Todolists\TodolistStoreRequest;

use App\Models\Todolist;

class TodolistController extends Controller
{
    public function index()
    {
        return response()->json([
            'todolists' => Todolist::getAll()
        ]);
    }

    public function store(TodolistStoreRequest $request)
    {
        return response()->json([
            'todolist' => Todolist::add( $request )
        ]);
    }

    public function show($id)
    {
        
    }
}
