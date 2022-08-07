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

use App\Http\Controllers\UserController;
use App\Http\Controllers\TodolistController;

Route::middleware('auth')->group(function(){

    // todolists routes
    Route::get('/', [TodolistController::class, 'index'])->name('home');
    Route::get('/list/{id}', [TodolistController::class, 'show'])->name('list');

    // tokens routes
    Route::get('/user/tokens', [UserController::class, 'getTokens'])->name('user.tokens');
    Route::post('/user/tokens', [UserController::class, 'store'])->name('user.tokens.store');
    Route::delete('/user/tokens/{token}', [UserController::class, 'delete'])->name('user.tokens.delete');
});

require __DIR__.'/auth.php';