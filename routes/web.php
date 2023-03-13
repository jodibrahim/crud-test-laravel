<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;


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
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['user.auth'])->group(function () {
    // Route for CMS
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProductController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}', [ProductController::class, 'show'])->name('produk.show');
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('produk.edit');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('produk.destroy');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('produk.update');

});

Route::middleware(['public.auth'])->group(function () {
    // Routes for Website
    Route::get('/public/home', [HomeController::class, 'publicHome'])->name('public.home');
});