<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\ChartController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });
});


Route::middleware('auth:api')->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::put('update/{id}', [UserController::class, 'update']);
    Route::get('show/{id}', [UserController::class, 'show']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::middleware('auth:api')->prefix('role')->group(function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::post('store', [RoleController::class, 'store']);
    Route::put('update/{id}', [RoleController::class, 'update']);
    Route::get('show/{id}', [RoleController::class, 'show']);
    Route::delete('/{id}', [RoleController::class, 'destroy']);
});

Route::middleware('auth:api')->prefix('book')->group(function () {
    Route::get('/', [BookController::class, 'index']);
    Route::post('store', [BookController::class, 'store']);
    Route::put('update/{id}', [BookController::class, 'update']);
    Route::get('show/{id}', [BookController::class, 'show']);
    Route::delete('/{id}', [BookController::class, 'destroy']);
});

Route::middleware('auth:api')->prefix('author')->group(function () {
    Route::get('/', [AuthorController::class, 'index']);
    Route::post('store', [AuthorController::class, 'store']);
    Route::put('update/{id}', [AuthorController::class, 'update']);
    Route::get('show/{id}', [AuthorController::class, 'show']);
    Route::delete('/{id}', [AuthorController::class, 'destroy']);
});

Route::middleware('auth:api')->prefix('chart')->group(function () {
    Route::get('/', [ChartController::class, 'index']);
    Route::post('store', [ChartController::class, 'store']);
    Route::put('update/{id}', [ChartController::class, 'update']);
    Route::get('show/{id}', [ChartController::class, 'show']);
    Route::delete('/{id}', [ChartController::class, 'destroy']);
});