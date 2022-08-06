<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\API\TodolistController;

// protected api routes
Route::group(['middleware' => ['auth:sanctum']], function(){

    // get routes
    Route::get('/', [TodolistController::class, 'index'])->name('todolists.index');
    Route::get('/todolists/{id}', [TodolistController::class, 'show'])->name('todolists.show');

    // post routes
    Route::post('/todolists', [TodolistController::class, 'store'])->name('todolists.store');
    
});