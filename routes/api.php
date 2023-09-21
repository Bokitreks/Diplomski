<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
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
    Route::get('/getAllUsers',[UserController::class,'getAllUsersAction'])->name('getAllUsersAction');
    Route::post('/editUser',[UserController::class,'editUserAction'])->name('editUserAction');
    Route::post('/deleteUser',[UserController::class,'deleteUserAction'])->name('deleteUserAction');
    Route::post('/addUser',[UserController::class,'addUserAction'])->name('addUserAction');
});
Route::prefix('products')->group(function () {
    Route::get('/getAllProducts',[ProductController::class,'getAllProductsAction'])->name('getAllProductsAction');
    Route::get('/getProducts',[ProductController::class,'getProductsAction'])->name('getProductsAction');
    Route::post('/sortProducts',[ProductController::class,'sortProductsAction'])->name('sortProductsAction');
    Route::post('/confirmOrderWithoutShipping',[ProductController::class,'confirmOrderWithoutShippingAction'])->name('confirmOrderWithoutShippingAction');
    Route::post('/confirmOrderWithShipping',[ProductController::class,'confirmOrderWithShippingAction'])->name('confirmOrderWithShippingAction');
});
Route::prefix('reviews')->group(function() {
    Route::post('/writeReview',[ReviewController::class, 'create'])->name('WriteReviewAction');
});
Route::prefix('categories')->group(function() {
    Route::get('/getAllCategories',[CategoryController::class, 'getAllCategoriesAction'])->name('getAllCategotiesAction');
    Route::delete('/deleteCategory',[CategoryController::class, 'deleteCategoryAction'])->name('deleteCategoryAction');
    Route::post('/addCategory',[CategoryController::class, 'addCategoryAction'])->name('addCategoryAction');
    Route::post('/editCategory',[CategoryController::class, 'editCategoryAction'])->name('editCategoryAction');
});


