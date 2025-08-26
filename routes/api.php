<?php

use App\Http\Controllers\Add\AddController;
use App\Http\Controllers\Add\UserAddController;
use App\Http\Controllers\Admins\Add\AdminAddsController;
use App\Http\Controllers\Analisator\AnalyzeController;
use App\Http\Controllers\Analisator\TeamController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Balance\BalanceController;
use App\Http\Controllers\City\CityController;
use App\Http\Controllers\Color\ColorController;
use App\Http\Controllers\Favorite\FavoriteController;
use App\Http\Controllers\Mark\MarkController;
use App\Http\Controllers\Messanger\ChatController;
use App\Http\Controllers\Model\ModelController;
use App\Http\Controllers\Reviews\ReviewsController;
use App\Http\Controllers\System\SystemController;
use App\Http\Controllers\Volume\VolumeController;
use App\Http\Controllers\YandexDisk\YandexDiskController;
use App\Http\Middleware\IsAdminValid;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\Auth\AuthController as AdminAuthController;

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

//teams
Route::get('/teams/getTeam', [TeamController::class, 'get']);
Route::resource('/teams', TeamController::class)
    ->only([
        'store',
        'index',
        'update',
        'show',
    ]);

//analyze
Route::post('/analyze', [AnalyzeController::class, 'analyze']);
Route::post('/heroes/update/win_rate', [AnalyzeController::class, 'updateHeroes']);
Route::post('/teams/update/players', [AnalyzeController::class, 'updateTeams']);
Route::post('/analyze/picks', [AnalyzeController::class, 'getPicks']);


Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/verification-code/create', [AuthController::class, 'createCode']);
Route::post('/verification-code/verify', [AuthController::class, 'verifyCode']);
Route::post('/user/reset', [AuthController::class, 'resetPassword']);

Route::post('/yandex', [YandexDiskController::class, 'index']);
Route::get('/mm', [SystemController::class, 'showEntities']);

Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', 'exception']], function () {

    Route::middleware(IsAdminValid::class)->prefix('/admin')->group(function (){
        Route::resource('/adds', AdminAddsController::class)
            ->only([
                'index',
                'update',
                'show',
            ]);
    });
    //chat
    Route::get('/messages', [ChatController::class, 'index']);
    Route::post('/messages/send', [ChatController::class, 'send']);
    Route::get('/messages/{id}', [ChatController::class, 'dialog']);
    Route::get('/messages/users/{id}', [ChatController::class, 'users']);
    Route::post('/messages/chat/create/{id}', [ChatController::class, 'create']);
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
    Route::get('/profile/{id}', [ProfileController::class, 'getProfile']);
    Route::get('/reviews', [ReviewsController::class, 'get']);
    Route::get('/reviews/{id}', [ReviewsController::class, 'getReviews']);
    Route::post('/reviews', [ReviewsController::class, 'store']);

    Route::post('/balance', [BalanceController::class, 'put']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/profile/test', [ProfileController::class, 'test']);

    //favorites
    Route::get('/favorite/add/{id}', [FavoriteController::class, 'add']);
    Route::get('/favorite/remove/{id}', [FavoriteController::class, 'remove']);
    Route::get('/favorite', [FavoriteController::class, 'index']);


    //user adds
    Route::resource('/user/adds', UserAddController::class)->only([
        'index',
    ]);

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


