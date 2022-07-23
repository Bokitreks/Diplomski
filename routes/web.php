<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages/home');
})->name('home');

Route::get('/contact',function() {
    return view('pages/contact');
})->name('contact');

Route::get('/about', function () {
    return view('pages/about');
})->name('about');

Route::get('/products', function () {
    return view('pages/products');
})->name('products');

Route::get('/register', function () {
    return view('pages/register');
})->name('register');

Route::get('/login', function () {
    return view('pages/login');
})->name('login');
