<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Hero\HeroController;
use App\Http\Controllers\Patterns\MediatrController;
use App\Http\Controllers\Rows\RowsController;
use App\Http\Controllers\Upload\ExcelController;
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

    Route::get('/user', [UserController::class, 'show']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/excel/upload', [ExcelController::class, 'upload']);
    Route::get('/rows', [RowsController::class, 'show']);

    Route::get('/mediatr', [MediatrController::class, 'show']);
    Route::post('/mediatr', [MediatrController::class, 'store']);

    Route::delete('/hero', [HeroController::class, 'destroy']);
    Route::resource('/hero', HeroController::class)
    ->only([
        'store',
        'index',
        'update',
        'show',
    ]);

});


