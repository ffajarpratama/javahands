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

    Route::resource('/product', \App\Http\Controllers\Admin\ProductController::class)
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
Route::get('/product/home', [ProductController::class, 'home'])
    ->name('product.home');

Route::get('/product', [ProductController::class, 'index'])
    ->name('product.index');
Route::get('/product/search', [ProductController::class, 'search'])
    ->name('product.search');
Route::get('/product/{product}', [ProductController::class, 'show'])
    ->name('product.show');
//END PRODUCT ROUTES

//USER ROUTES
Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    //COMMENT ROUTES
    Route::post('/comment/{product}/{user}', [\App\Http\Controllers\CommentController::class, 'store'])
        ->name('comment.store');
    Route::put('/comment/{comment}', [\App\Http\Controllers\CommentController::class, 'update'])
        ->name('comment.update');
    Route::delete('/comment/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])
        ->name('comment.delete');
    //END COMMENT ROUTES

    //LIKE ROUTES
    Route::post('/likes/{comment_id}', [\App\Http\Controllers\LikeController::class , 'like'])
        ->name('likes.add');
    //END LIKE ROUTES
    //DISLIKE ROUTES
    Route::post('/dislikes/{comment_id}', [\App\Http\Controllers\DislikeController::class, 'dislike'])
        ->name('dislikes.add');
    //END DISLIKE ROUTES

    //CART ROUTES
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])
        ->name('cart.index');
    //END CART ROUTES
});
//END USER ROUTES

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
