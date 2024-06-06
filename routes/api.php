<?php

use App\Http\Controllers\Add\AddController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Balance\BalanceController;
use App\Http\Controllers\City\CityController;
use App\Http\Controllers\Color\ColorController;
use App\Http\Controllers\Mark\MarkController;
use App\Http\Controllers\Model\ModelController;
use App\Http\Controllers\System\SystemController;
use App\Http\Controllers\Volume\VolumeController;
use App\Http\Controllers\YandexDisk\YandexDiskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Api!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/verification-code/create', [AuthController::class, 'createCode']);
Route::post('/verification-code/verify', [AuthController::class, 'verifyCode']);
Route::post('/user/reset', [AuthController::class, 'resetPassword']);

Route::post('/yandex', [YandexDiskController::class, 'index']);
Route::get('/mm', [SystemController::class, 'showEntities']);


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

    //profile
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/balance', [BalanceController::class, 'put']);
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


