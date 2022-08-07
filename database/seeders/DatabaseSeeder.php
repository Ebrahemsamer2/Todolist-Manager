<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Route;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::factory(1)->create();
        \App\Models\Todolist::factory(1)->create();
        \App\Models\Task::factory(1)->create();
    }
}