<?php

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

// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/register', [AuthController::class, 'register']);


Route::group(['middleware' => ['scope.bulletin']], function () {
    Route::get('/get', [BulletinController::class, 'index']);
    Route::post('/create', [BulletinController::class, 'store']);
    Route::post('/update/{id}', [BulletinController::class, 'update']);
    Route::get('/show/{id}', [BulletinController::class, 'show']);
    Route::delete('/destroy/{id}', [BulletinController::class, 'destroy']);
});
