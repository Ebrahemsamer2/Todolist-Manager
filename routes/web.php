<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function(){

    Route::get('/', function(){
        return view('todolist.index');
    })->name('home');

    Route::get('/list/hey', function(){
        return view('todolist.show');
    })->name('list');
    
});

require __DIR__.'/auth.php';