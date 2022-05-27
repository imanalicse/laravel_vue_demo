<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use \App\Http\Controllers\Api\ProductsController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/user', function (Request $request){
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/products', [ProductsController::class, 'store']);
    Route::get('/products', [ProductsController::class, 'index']);
    Route::get('/products/{id}', [ProductsController::class, 'show']);
    Route::delete('/products/{id}', [ProductsController::class, 'delete']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/products/{id}', [ProductsController::class, 'show']);
