<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiProductController;
use App\Http\Controllers\ApiTransactionController;
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
    // Auth
    Route::post('register', [ApiAuthController::class, 'register']);
    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('logout', [ApiAuthController::class, 'logout']);
    // Route::post('refresh', [ApiAuthController::class, 'refresh']); //!! DELETED
    Route::get('user', [ApiAuthController::class, 'user']); //!! ADMIN

    // Update Profile
    Route::post('user/update', [ApiAuthController::class, 'update']);
    Route::post('user/change-password', [ApiAuthController::class, 'changePassword']);

    // List Category
    Route::get('category', [ApiProductController::class, 'indexCategory']);

    // Transaction
    Route::get('user/transaction/all', [ApiTransactionController::class, 'indexAll']); //!! ADMIN
    Route::get('user/transaction', [ApiTransactionController::class, 'index']);
    Route::get('user/transaction/{id}', [ApiTransactionController::class, 'show']);
    Route::post('user/transaction', [ApiTransactionController::class, 'store']);
    Route::post('user/transaction/{id}', [ApiTransactionController::class, 'update']);
    Route::delete('user/transaction/{id}', [ApiTransactionController::class, 'destroy']);
    Route::post('user/transaction/status/{id}', [ApiTransactionController::class, 'updateStatus']); //!! ADMIN

    // Notif, History, & Cart
    Route::get('user/cart', [ApiTransactionController::class, 'indexCart']);
    Route::get('user/cart/{id}', [ApiTransactionController::class, 'indexCartDetail']);
    Route::get('user/history', [ApiTransactionController::class, 'indexHistory']);
    Route::get('user/notification', [ApiTransactionController::class, 'indexNotification']);
    Route::post('user/notification/{id}', [ApiTransactionController::class, 'readNotification']);
});

// Product
Route::apiResource('product', ApiProductController::class);
