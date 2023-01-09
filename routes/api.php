<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OrderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('requestToken', [APIController::class, 'requestToken']);
Route::post('requestTokenGoogle', [APIController::class, 'requestTokenGoogle']);
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/order', [OrderController::class,'createOrder']);
Route::put('/orderu/{id}', [OrderController::class,'updateOrder']);
Route::get('product/showAll', [ProductController::class,'showall'])->name('product.showall');
