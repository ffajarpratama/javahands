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
use App\Models\Category;

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

//url: /, GET
Route::get('/', function () {
    $landing_categories = Category::query()
        ->withCount('products')
        ->latest()
        ->take(3)
        ->get();
    return view('landing', compact('landing_categories'));
})->name('landing');

//url: /about, GET
Route::get('/about', function () {
    return view('about');
})->name('about');

//AUTH ROUTES===========================================================================================
//REGISTER ROUTES=======================================================================================
//url: /register, GET
Route::get('register', [AuthController::class, 'getRegisterPage'])
    ->name('register');
//url: /register, POST
Route::post('register', [AuthController::class, 'storeUserDetails'])
    ->name('register.first.step');
//url: /getStates/{id country yang dipilih di dropdown country}, GET
Route::get('/getStates/{id}', [AuthController::class, 'getStates'])
    ->name('register.get.states');
//url: /register/address, GET
Route::get('register/address', [AuthController::class, 'getStepTwoRegisterPage'])
    ->name('register.address');
//url: /register/address, POST
Route::post('register/address', [AuthController::class, 'storeUserToDatabase'])
    ->name('register.second.step');
//END REGISTER ROUTES===================================================================================

//LOGIN ROUTE===========================================================================================
//secara default laravel udah bikinin route buat auth sendiri
//tapi karena registernya dibikin custom, registernya diset ke false, reset password juga diset ke false
//karena reset password ga dipake
Auth::routes(['register' => false, 'reset' => false]);
//END LOGIN ROUTE=======================================================================================

//REDIRECT ROUTES=======================================================================================
//buat redirect berdasarkan kolom is_admin
Route::get('/redirect', function () {
    //kalau user belum login
    if (!Auth::check()) {
        //redirect ke url: /
        return redirect()->route('landing');
    }
    //kalau admin
    if (Auth::user()->is_admin) {
        //redirect ke url: /admin/dashboard/
        return redirect()->route('admin.dashboard');
    }
    //kalau bukan admin
    //redirect ke url: /product
    return redirect()->route('product.index');
});
//END REDIRECT ROUTES===================================================================================
//END AUTH ROUTES=======================================================================================

//ADMIN ROUTES==========================================================================================
//grouping url buat admin biar diawalin /admin dan biar nama routenya 'admin.{nama-route}'
//grouping url buat admin biar pake middleware auth (harus login dulu) dan auth.admin (is_admin harus true)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'auth.admin'])->group(function () {
//ADMIN DASHBOARD
    //url: /admin/dashboard, method: GET, name: admin.dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');

    //url: /admin/product/create, method: GET, name: admin.product.create
    //url: /admin/product/edit/{id product}, method: GET, name: admin.product.edit
    //url: /admin/product/update/{id product}, method: PUT, name: admin.product.update
    //url: /admin/product/delete/{id product}, method: DELETE, name: admin.product.delete
    Route::resource('/product', \App\Http\Controllers\Admin\ProductController::class)
        ->except(['index', 'show']);

    //url: /admin/categories, method: GET, name: admin.categories.index
    //url: /admin/categories/create, method: GET, name: admin.categories.create
    //url: /admin/categories, method: POST, name: admin.categories.store
    //url: /admin/categories/show/{id category}, method: GET, name: admin.categories.show
    //url: /admin/categories/edit/{id category}, method: GET, name: admin.categories.edit
    //url: /admin/categories/update/{id category}, method: PUT, name: admin.categories.update
    //url: /admin/categories/delete/{id category}, method: DELETE, name: admin.categories.delete
    Route::resource('/categories', CategoryController::class)
        ->except('show');

    //url: /admin/addReply/{id comment}, method: POST, name: admin.addReply
    Route::post('/addReply/{comment}', [ReplyController::class, 'addReply'])
        ->name('reply.add');
    //url: /admin/updateReply/{id comment}, method: PUT, name: admin.updateReply
    Route::put('/updateReply/{reply}', [ReplyController::class, 'updateReply'])
        ->name('reply.update');
    //url: /admin/deleteReply/{id comment}, method: DELETE, name: admin.deleteReply
    Route::delete('/deleteReply/{reply}', [ReplyController::class, 'deleteReply'])
        ->name('reply.delete');

    //url: /admin.order/details/{id order}, method:GET, name: admin.order.details
    Route::get('order/details/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'details'])
        ->name('order.details');
    //url: /admin.order/updateOrderProgress/{id order}, method:PUT, name: admin.order.update-progress
    Route::put('order/updateOrderProgress/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'updateOrderProgress'])
        ->name('order.update-progress');
});

//PRODUCT ROUTES========================================================================================
//url: /product/home, method: GET, name: product.home
Route::get('/product/home', [ProductController::class, 'home'])
    ->name('product.home');
//url: /product/index, method: GET, name: product.index
//url: /product/index/?categories={category name}, method: GET, name: product.index
//url: /product/index/?categories={category name}&sortBy={column name}, method: GET, name: product.index
Route::get('/product', [ProductController::class, 'index'])
    ->name('product.index');
//url: /product/search, method: GET, name: product.search
Route::get('/product/search', [ProductController::class, 'search'])
    ->name('product.search');
//url: /product/{id product}, method: GET, name: product.show
Route::get('/product/{product}', [ProductController::class, 'show'])
    ->name('product.show');
//END PRODUCT ROUTES====================================================================================


//grouping url buat like/dislike
//pake middleware auth soalnya yang bisa like/dislike cuma user yang udah login
//admin sama user bisa like/dislike product
Route::middleware('auth')->group(function () {
    //LIKE ROUTES=======================================================================================
    //url: /likes/{id comment}, method: POST, name: likes.add
    Route::post('/likes/{comment_id}', [LikeController::class, 'like'])
        ->name('likes.add');
    //END LIKE ROUTES===================================================================================
    //DISLIKE ROUTES====================================================================================
    //url: /dislikes/{id comment}, method: POST, name: dislikes.add
    Route::post('/dislikes/{comment_id}', [DislikeController::class, 'dislike'])
        ->name('dislikes.add');
    //END DISLIKE ROUTES================================================================================
});

//USER ROUTES===========================================================================================
//grouping url buat user biar diawalin /user dan biar nama routenya 'user.{nama-route}'
//grouping url buat user biar pake middleware auth (harus login dulu)
Route::prefix('user')->name('user.')->middleware(['auth', 'auth.user'])->group(function () {
    //PROFILE ROUTES====================================================================================
    //url: /user/profile/{id user}, method: GET, name: user.profile.details
    Route::get('/profile/{user}', [\App\Http\Controllers\ProfileController::class, 'getUserProfile'])
        ->name('profile.details');
    //url: /user/profile/update/{id user}, method: PUT, name: user.profile.update
    Route::put('/profile/update/{user}', [\App\Http\Controllers\ProfileController::class, 'updateProfile'])
        ->name('profile.update');
    //END PROFILE ROUTES================================================================================

    //COMMENT ROUTES====================================================================================
    //url: user.comment/{id comment}/{id user}, method: POST, name: user.comment.store
    Route::post('/comment/{product}/{user}', [CommentController::class, 'store'])
        ->name('comment.store');
    //url: user.comment/{id comment}, method: PUT, name: user.comment.update
    Route::put('/comment/{comment}', [CommentController::class, 'update'])
        ->name('comment.update');
    //url: user.comment/{id comment}, method: DELETE, name: user.comment.delete
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])
        ->name('comment.delete');
    //END COMMENT ROUTES================================================================================

    //CART ROUTES=======================================================================================
    //url: /user/cart, method: GET, name: user.cart.index
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');
    //url: /user/cart/{id product}/{id user}, method: POST, name: user.cart.store
    Route::post('/cart/{product}/{user}', [CartController::class, 'store'])
        ->name('cart.store');
    //END CART ROUTES===================================================================================

    //ORDER ROUTES======================================================================================
    //url: user/order, method: GET, name: user.order.index
    Route::get('/order', [OrderController::class, 'index'])
        ->name('order.index');
    //url: user/order/create, method: GET, name: user.order.create
    Route::get('/order/create', [OrderController::class, 'create'])
        ->name('order.create');
    //url: user/order, method: POST, name: user.order.store
    Route::post('/order', [OrderController::class, 'store'])
        ->name('order.store');
    //url: user/order/details/{id order}, method: GET, name: user.order.details
    Route::get('/order/details/{order}', [OrderController::class, 'details'])
        ->name('order.details');
    //url: user/order/received/{id order}, method: PUT, name: user.order.received
    Route::put('/order/received/{order}', [OrderController::class, 'received'])
        ->name('order.received');
    //END ORDER ROUTES==================================================================================

    //PAYMENT ROUTE=====================================================================================
    //url: /user/order/payment/{id order}, method: PUT, name: user.order.payment
    Route::put('/order/payment/{order}', [PaymentController::class, 'storePayment'])
        ->name('order.payment');
    //END PAYMENT ROUTE=================================================================================
});
//END USER ROUTES=======================================================================================
