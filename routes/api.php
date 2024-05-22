<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Task\TaskController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', 'exception']], function(){

    //users
    Route::post('/user/banned', [UserController::class, 'banned']);
    Route::post('/user/unbanned', [UserController::class, 'unbanned']);
    Route::resource('/user', UserController::class)
    ->only([
        'store',
        'index',
        'update',
        'show',
    ]);

    Route::post('/logout', [AuthController::class, 'logout']);

    //tasks
    Route::resource('/tasks', TaskController::class)
        ->only([
            'store',
            'index',
            'update',
            'show',
        ]);

});


