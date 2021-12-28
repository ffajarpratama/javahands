<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

//ADMIN ROUTES
Route::prefix('admin')->name('admin.')->middleware(['auth', 'auth.admin'])->group(function () {
//ADMIN DASHBOARD
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');

    Route::resource('/products', \App\Http\Controllers\Admin\ProductController::class);
    Route::get('/products/category/{category}', [\App\Http\Controllers\Admin\ProductController::class, 'getProductByCategory'])
        ->name('products.get_by_category');
    Route::resource('/categories', \App\Http\Controllers\Admin\CategoryController::class)
        ->except('show');
});

//USER ROUTES
Route::prefix('user')->name('user.')->group(function () {
    Route::resource('/products', ProductController::class);
    Route::get('/products/category/{category}', [ProductController::class, 'getProductByCategory'])
        ->name('products.get_by_category');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
