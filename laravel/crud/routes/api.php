<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);


Route::post('registerCategory', [CategoryController::class, 'registerCategory']);
Route::post('updateCategory', [CategoryController::class, 'updateCategory']);
Route::delete('deleteCategory', [CategoryController::class, 'deleteCategory']);
Route::post('readCategory', [CategoryController::class, 'readCategory']);


Route::post('registerProduct', [ProductController::class, 'registerProduct']);
Route::post('updateProduct', [ProductController::class, 'updateProduct']);
Route::delete('deleteProduct', [ProductController::class, 'deleteProduct']);
Route::post('readProduct', [ProductController::class, 'readProduct']);

Route::group(['middleware' => ["auth:sanctum"]], function(){
    Route::get('user-profile', [UserController::class, 'userProfile']);
    Route::get('logout', [UserController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
