<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ElementsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TrackingController;
use App\Models\Account;
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

Route::group(['prefix' => ''], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/index', [HomeController::class, 'index']);
});

Route::group(['prefix' => 'home'], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/index', [HomeController::class, 'index']);
    Route::post('/index', [HomeController::class, 'index']);
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/index', [AdminController::class, 'index']);
    Route::get('/addSlider', [AdminController::class, 'addSlider']);
    Route::get('/allSlider', [AdminController::class, 'allSlider']);
    Route::get('/addProducts', [AdminController::class, 'addProducts']);
    Route::get('/allProducts', [AdminController::class, 'allProducts']);
    Route::get('/addCategories', [AdminController::class, 'addCategories']);
    Route::get('/allCategories', [AdminController::class, 'allCategories']);
    Route::get('/managementOrder', [AdminController::class, 'managementOrder']);
    Route::get('/customers', [AdminController::class, 'customers']);
});

Route::group(['prefix' => 'cate'], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/index', [CategoryController::class, 'index']);
});

Route::group(['prefix' => 'shop'], function () {
    Route::get('/', [ShopController::class, 'shopCategory']);
    Route::get('/shopCategory', [ShopController::class, 'shopCategory'])->name('shop.category');
    Route::get('/shop/filter', [ShopController::class, 'shopCategory'])->name('shop.filter');
    Route::get('/productCheckout', [ShopController::class, 'productCheckout']);
    Route::get('/shoppingCart', [ShopController::class, 'shoppingCart']);
    Route::get('/confirmation', [ShopController::class, 'confirmation']);
    Route::get('/productDetails/{id}', [ShopController::class, 'show']);
    Route::get('/search-by-keyword', [ShopController::class, 'searchByKeyword']);
    Route::get('/shoppingCart', [ShopController::class, 'showCart']);
    



    Route::get('/shoppingCart/{id}', [ShopController::class, 'removeFromCart']);
    

    Route::post('/shoppingCart/{id}', [ShopController::class, 'updateCart']);
    Route::post('/shoppingCart', [ShopController::class, 'addToCart']);
});
Route::group(['prefix' => 'blog'], function () {
    Route::get('/index', [BlogController::class, 'index']);
    Route::get('/blogDetails', [BlogController::class, 'blogDetails']);
});

Route::group(['prefix' => 'contact'], function () {
    Route::get('/', [ContactController::class, 'index']);
    Route::get('/index', [ContactController::class, 'index']);
});


// Đăng ký route cho AccountController
Route::group(['prefix' => 'account'], function () {
    // 👇 Thêm name để dùng trong Blade
    Route::get('/', [AccountController::class, 'index'])->name('account.login');
    Route::post('/login', [AccountController::class, 'login'])->name('account.doLogin');
    Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout'); // nếu chưa có thì thêm luôn

    Route::get('/register', [AccountController::class, 'register'])->name('account.register');
    Route::post('/register', [AccountController::class, 'registerHandle'])->name('account.doRegister');
});




// Trang chỉ admin được vào
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'Hi admin!';
    });
});

// Trang dành cho user bình thường
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/user/dashboard', function () {
        return 'Hi user!';
    });
});

Route::group(['prefix' => 'tracking'], function () {
    Route::get('/', [TrackingController::class, 'index']);
    Route::get('/index', [TrackingController::class, 'index']);
});

Route::group(['prefix' => 'elements'], function () {
    Route::get('/', [ElementsController::class, 'index']);
    Route::get('/index', [ElementsController::class, 'index']);
});
