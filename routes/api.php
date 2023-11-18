<?php

use App\Http\Controllers\APIs\Admin\CategoryController;
use App\Http\Controllers\APIs\Admin\ProductController;
use App\Http\Controllers\APIs\Auth\SocialiteController;
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

Route::get('auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');

Route::group(['middleware' => ['auth:sanctum', 'is_admin'], 'prefix' => 'admin'], function () {
    Route::get('get-all-category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('store-category', [CategoryController::class, 'store'])->name('category.store');
    Route::put('{id}/update-category', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('{id}/delete-category', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('{id}/get-all-descendants-and-self-category', [CategoryController::class, 'getAllDescendantsAndSelf'])->name('category.get-all-descendants-and-self');

    Route::get('get-all-product', [ProductController::class, 'index'])->name('product.index');
    Route::post('store-product', [ProductController::class, 'store'])->name('product.store');
    Route::put('{id}/update-product', [ProductController::class, 'update'])->name('product.update');
    Route::delete('{id}/delete-product', [ProductController::class, 'delete'])->name('product.delete');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('auth-user', [SocialiteController::class, 'authUser'])->name('socialite.auth-user');
});
