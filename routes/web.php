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

    Route::resource('/products', \App\Http\Controllers\Admin\ProductController::class)
        ->except(['index', 'show']);

    Route::resource('/categories', \App\Http\Controllers\Admin\CategoryController::class)
        ->except('show');

    Route::post('/addReply/{comment}', [\App\Http\Controllers\Admin\ReplyController::class, 'addReply'])
        ->name('reply.add');
    Route::put('/updateReply/{reply}', [\App\Http\Controllers\Admin\ReplyController::class, 'updateReply'])
        ->name('reply.update');
    Route::delete('/deleteReply/{reply}', [\App\Http\Controllers\Admin\ReplyController::class, 'deleteReply'])
        ->name('reply.delete');
});

//PRODUCT ROUTES
Route::get('/products/home', [ProductController::class, 'home'])
    ->name('products.home');

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');
Route::get('/products/search', [ProductController::class, 'search'])
    ->name('products.search');
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');
//END PRODUCT ROUTES

//USER ROUTES
Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    //COMMENT ROUTES
    Route::post('/comments/{product}/{user}', [\App\Http\Controllers\CommentController::class, 'store'])
        ->name('comments.store');
    Route::put('/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'update'])
        ->name('comments.update');
    Route::delete('/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])
        ->name('comments.delete');
    //END COMMENT ROUTES

    //LIKE ROUTES
    Route::post('/likes/{comment_id}', [\App\Http\Controllers\LikeController::class , 'like'])
        ->name('likes.add');
    //END LIKE ROUTES
    //DISLIKE ROUTES
    Route::post('/dislikes/{comment_id}', [\App\Http\Controllers\DislikeController::class, 'dislike'])
        ->name('dislikes.add');
    //END DISLIKE ROUTES
});
//END USER ROUTES

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
