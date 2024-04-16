<?php

use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\Image_ProductController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\Sub_CategoryController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/categories', [CategoryController::class, 'getAllCategories']);

Route::get('/categories/{cate_id}', [CategoryController::class, 'getCategoryProduct']);
Route::get('/sub-categories/{cate_id}', [Sub_CategoryController::class, 'getSub_CategoryProduct']);

Route::post('/create-category', [CategoryController::class, 'store']);
Route::put('/update-category', [CategoryController::class, 'update']);
Route::delete('/delete-category/{id}', [CategoryController::class, 'delete']);
Route::get('/product/{product_id}/detail', [ProductController::class, 'getProductDetailByProductId']);
Route::post('/image-upload', [Image_ProductController::class, 'upload']);

//APi Cart

Route::get('carts', [CartController::class, 'index']);
Route::get('carts/{id}', [CartController::class, 'show']);
Route::post('carts', [CartController::class, 'store']);
Route::put('carts/{id}', [CartController::class, 'update']);
Route::delete('carts/{id}', [CartController::class, 'destroy']);

//API Product

Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);
Route::post('products', [ProductController::class, 'store']);
Route::put('products/{id}', [ProductController::class, 'update']);
Route::delete('products/{id}', [ProductController::class, 'destroy']);

//API user

Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);
