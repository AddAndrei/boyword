<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Hero\HeroController;
use App\Http\Controllers\Maps\MapController;
use App\Http\Controllers\Patterns\MediatrController;
use App\Http\Controllers\Resources\ResourceController;
use App\Http\Controllers\Resources\ResourceTypeController;
use App\Http\Controllers\Rows\RowsController;
use App\Http\Controllers\Tiles\TileController;
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

    //heroes
    Route::delete('/hero', [HeroController::class, 'destroy']);
    Route::resource('/hero', HeroController::class)
    ->only([
        'store',
        'index',
        'update',
        'show',
    ]);

    //maps
    Route::delete('/maps', [MapController::class, 'destroy']);
    Route::resource('/maps', MapController::class)
    ->only([
        'store',
        'index',
        'update',
        'show',
    ]);

    //tiles
    Route::delete('/tile', [TileController::class, 'destroy']);
    Route::resource('/tile', TileController::class)
        ->only([
            'store',
            'index',
            'update',
            'show',
        ]);

    //resources
    Route::resource('/resource-type', ResourceTypeController::class)
    ->only([
        'store',
        'index',
        'update',
        'show',
    ]);

    Route::resource('/resource', ResourceController::class)->only([
        'store',
        'index',
        'update',
        'show',
    ]);

});


