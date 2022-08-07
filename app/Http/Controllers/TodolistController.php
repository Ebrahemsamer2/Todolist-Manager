<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todolist;

class TodolistController extends Controller
{
    public function index()
    {
        return view('todolist.index');
    }

    public function show($id)
    {
        return view('todolist.show', [
            'id' => $id
        ]);
    }
}
