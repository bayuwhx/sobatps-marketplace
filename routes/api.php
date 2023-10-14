<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user', [AuthController::class, 'user']);

    Route::put('user/update', [AuthController::class, 'update']);

    Route::get('category', [ProductController::class, 'indexCategory']);
});

Route::apiResource('products', ProductController::class);

// Route::apiResource('user', UserController::class);

// !! GA DIPAKE
// Route::get(['middleware' => 'api'], function ($router) {
//     Route::get('category', [ProductController::class, 'indexCategory']);
// });

// Route::group(['middleware' => 'api', 'prefix' => 'user'], function ($router) {
//     Route::get('index', [UserController::class, 'index']);
//     Route::put('update', [UserController::class, 'update']);
// });
