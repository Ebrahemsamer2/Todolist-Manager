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

Route::middleware('auth')->group(function(){

    Route::get('/', function(){
        return view('todolist.index');
    })->name('home');

    Route::get('/list/{id}', function(){
        return view('todolist.show');
    })->name('list');

    Route::get('/user/tokens', [UserController::class, 'getTokens'])->name('user.tokens');
    Route::post('/user/tokens', [UserController::class, 'store'])->name('user.tokens.store');
    Route::delete('/user/tokens/{token}', [UserController::class, 'delete'])->name('user.tokens.delete');
});

require __DIR__.'/auth.php';