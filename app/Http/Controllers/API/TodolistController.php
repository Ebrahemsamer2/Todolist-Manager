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
            'todolists' => Todolist::getUserTodoLists()
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
        return response()->json([
            'todolist' => Todolist::get( $id )
        ]);
    }

    public function update(TodolistStoreRequest $request, $id)
    {
        return response()->json([
            'todolist' => Todolist::modify($request, $id)
        ]);
    }

    public function destroy($id)
    {
        return response()->json([
            'success' => Todolist::remove( $id )
        ]);
    }
}
