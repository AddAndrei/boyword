<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Rows\RowsController;
use App\Http\Controllers\TestController;
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

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/excel/upload', [ExcelController::class, 'upload']);

    Route::get('/rows', [RowsController::class, 'show']);
});
