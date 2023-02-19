<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
Route::prefix('user')->group(function () {
    Route::post('/register',[UserController::class,'registerAction'])->name('registerAction');
    Route::post('/login',[UserController::class,'loginAction'])->name('loginAction');
    Route::get('/logout',[UserController::class,'logoutAction'])->name('logoutAction');
});
Route::prefix('products')->group(function () {
    Route::get('/getAllProducts',[ProductController::class,'getAllProductsAction'])->name('getAllProductsAction');
    Route::get('/getSigurnosnaVrata',[ProductController::class,'getSigurnosnaVrataAction'])->name('getSigurnosnaVrataAction');
    Route::get('/getSobnaVrata',[ProductController::class,'getSobnaVrataAction'])->name('getSobnaVrataAction');
    Route::get('/getPvcStolarija',[ProductController::class,'getPvcStolarijaAction'])->name('getPvcStolarijaAction');
    Route::post('/sortProducts',[ProductController::class,'sortProductsAction'])->name('sortProductsAction');
});


