<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PlaceToPayTransaction;
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

//Route::prefix('products')->group(function () {
//    Route::get('/', [ProductController::class, 'index']);
//});

Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::post('/', [OrderController::class, 'store']);
});

Route::prefix('ordersproducts')->group(function () {
    Route::get('/', [OrderProductController::class, 'index']);
    Route::post('/', [OrderProductController::class, 'store']);
});

Route::prefix('transaction')->group(function () {
    Route::get('/status', [PlaceToPayTransaction::class, 'transactionStatus']);
    Route::post('/session', [PlaceToPayTransaction::class, 'createSession']);
});
