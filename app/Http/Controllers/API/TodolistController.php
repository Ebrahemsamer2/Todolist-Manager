<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Todolist;

class TodolistController extends Controller
{
    public function index()
    {
        return response()->json([
            'todolists' => Todolist::getAll()
        ]);
    }

    public function show($id)
    {
        
    }
}
