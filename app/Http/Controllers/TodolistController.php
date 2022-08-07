<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodolistController extends Controller
{
    public function index()
    {
        return view('todolist.index');
    }

    public function show()
    {
        return view('todolist.show');
    }
}
