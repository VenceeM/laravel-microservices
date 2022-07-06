<?php

use App\Http\Controllers\AllBulletinController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BulletinController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


// Protected Routes
Route::group(['middleware' => ['scope.api.gateway']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Bulletin
    Route::group(['prefix' => '/bulletin'], function () {
        Route::post('/login', [BulletinController::class, 'login']);
        Route::get('/get', [BulletinController::class, 'index']);
        Route::post('/store', [BulletinController::class, 'store']);
        Route::post('/update/{id}', [BulletinController::class, 'update']);
        Route::get('/show/{id}', [BulletinController::class, 'show']);
        Route::delete('/destroy/{id}', [BulletinController::class, 'destroy']);
    });

    // All Services
    Route::group(['prefix' => '/all-bulletin'], function () {
        Route::get('/get', [AllBulletinController::class, 'index']);
    });
});
