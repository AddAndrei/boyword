<?php

use App\Http\Controllers\Add\AddController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\City\CityController;
use App\Http\Controllers\Color\ColorController;
use App\Http\Controllers\Mark\MarkController;
use App\Http\Controllers\Model\ModelController;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\Volume\VolumeController;
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
Route::post('/verification-code/create', [AuthController::class, 'createCode']);
Route::post('/verification-code/verify', [AuthController::class, 'verifyCode']);
Route::post('/user/reset', [AuthController::class, 'resetPassword']);



Route::group(['middleware' => ['auth:sanctum', 'exception']], function(){

    //users
    /*Route::post('/user/banned', [UserController::class, 'banned']);
    Route::post('/user/unbanned', [UserController::class, 'unbanned']);
    Route::resource('/user', UserController::class)
    ->only([
        'store',
        'index',
        'update',
        'show',
    ]);*/

    Route::post('/logout', [AuthController::class, 'logout']);

    //adds
    Route::delete('/adds', [AddController::class, 'destroy']);
    Route::resource('/adds', AddController::class)
        ->only([
            'store',
            'index',
            'update',
            'show',
        ]);

    //volumes
    Route::delete('/volumes', [VolumeController::class, 'destroy']);
    Route::resource('/volumes', VolumeController::class)
        ->only([
            'store',
            'index',
            'update',
            'show',
        ]);

    //colors
    Route::delete('/colors', [ColorController::class, 'destroy']);
    Route::resource('/colors', ColorController::class)
        ->only([
            'store',
            'index',
            'update',
            'show',
        ]);

    //models
    Route::delete('/models', [ModelController::class, 'destroy']);
    Route::resource('/models', ModelController::class)
        ->only([
            'store',
            'index',
            'update',
            'show',
        ]);

    //marks
    Route::delete('/marks', [MarkController::class, 'destroy']);
    Route::resource('/marks', MarkController::class)
        ->only([
            'store',
            'index',
            'update',
            'show',
        ]);


    //cities
    Route::delete('/cities', [CityController::class, 'destroy']);
    Route::resource('/cities', CityController::class)
        ->only([
            'store',
            'index',
            'update',
            'show',
        ]);

});


