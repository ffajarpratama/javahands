<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReplyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
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
    return view('landing');
})->name('landing');
Route::get('/about', function () {
    return view('about');
})->name('about');

//AUTH ROUTES
//REGISTER ROUTES
Route::get('register', [AuthController::class, 'getRegisterPage'])
    ->name('register');
Route::post('register', [AuthController::class, 'storeUserDetails'])
    ->name('register.first.step');
Route::get('/getStates/{id}', [AuthController::class, 'getStates'])
    ->name('register.get.states');
Route::get('register/address', [AuthController::class, 'getStepTwoRegisterPage'])
    ->name('register.address');
Route::post('register/address', [AuthController::class, 'storeUserToDatabase'])
    ->name('register.second.step');
//END REGISTER ROUTES

//LOGIN ROUTE
Auth::routes(['register' => false, 'reset' => false]);
//END LOGIN ROUTE

//REDIRECT ROUTES
Route::get('/redirect', function () {
    if (!Auth::check()) {
        return redirect()->route('landing');
    }
    if (Auth::user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('product.index');
});
//END REDIRECT ROUTES
//END AUTH ROUTES

//ADMIN ROUTES
Route::prefix('admin')->name('admin.')->middleware(['auth', 'auth.admin'])->group(function () {
//ADMIN DASHBOARD
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');

    Route::resource('/product', \App\Http\Controllers\Admin\ProductController::class)
        ->except(['index', 'show']);

    Route::resource('/categories', CategoryController::class)
        ->except('show');

    Route::post('/addReply/{comment}', [ReplyController::class, 'addReply'])
        ->name('reply.add');
    Route::put('/updateReply/{reply}', [ReplyController::class, 'updateReply'])
        ->name('reply.update');
    Route::delete('/deleteReply/{reply}', [ReplyController::class, 'deleteReply'])
        ->name('reply.delete');

    Route::get('order/details/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'details'])
        ->name('order.details');
    Route::put('order/updateOrderProgress/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'updateOrderProgress'])
        ->name('order.update-progress');
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
Route::prefix('user')->name('user.')->middleware(['auth', 'auth.user'])->group(function () {
    //PROFILE ROUTES
    Route::get('/profile/{user}', [\App\Http\Controllers\ProfileController::class, 'getUserProfile'])
        ->name('profile.details');
    Route::put('/profile/update/{user}', [\App\Http\Controllers\ProfileController::class, 'updateProfile'])
        ->name('profile.update');
    //END PROFILE ROUTES

    //COMMENT ROUTES
    Route::post('/comment/{product}/{user}', [CommentController::class, 'store'])
        ->name('comment.store');
    Route::put('/comment/{comment}', [CommentController::class, 'update'])
        ->name('comment.update');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])
        ->name('comment.delete');
    //END COMMENT ROUTES

    //LIKE ROUTES
    Route::post('/likes/{comment_id}', [LikeController::class, 'like'])
        ->name('likes.add');
    //END LIKE ROUTES
    //DISLIKE ROUTES
    Route::post('/dislikes/{comment_id}', [DislikeController::class, 'dislike'])
        ->name('dislikes.add');
    //END DISLIKE ROUTES

    //CART ROUTES
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');
    Route::post('/cart/{product}/{user}', [CartController::class, 'store'])
        ->name('cart.store');
    //END CART ROUTES

    //ORDER ROUTES
    Route::get('/order', [OrderController::class, 'index'])
        ->name('order.index');
    Route::get('/order/create', [OrderController::class, 'create'])
        ->name('order.create');
    Route::post('/order', [OrderController::class, 'store'])
        ->name('order.store');
    Route::get('/order/details/{order}', [OrderController::class, 'details'])
        ->name('order.details');
    Route::put('/order/received/{order}', [OrderController::class, 'received'])
        ->name('order.received');

    Route::put('/order/payment/{order}', [PaymentController::class, 'storePayment'])
        ->name('order.payment');
    //END ORDER ROUTES
});
//END USER ROUTES
