<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\LoginController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\MenuController;


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

Route::get('/admin/users/login', [LoginController::class, 'index'])->name('login');

Route::post('admin/users/login/store', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {

        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);


        #Menu
        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);

            Route::delete('destroy', [MenuController::class, 'destroy']);
        });
        #Product
        Route::prefix('products')->group(function () {
        });
    });
});


Route::prefix('shop')->group(function () {
    Route::get('home', function () {
        return view('client.home.home');
    });

    Route::get('gallery', function () {
        return view('client.gallery.gallery');
    });

    Route::get('about-us', function () {
        return view('client.about.about-us');
    });

    Route::get('cart', function () {
        return view('client.cart.cart');
    });

    Route::get('checkout', function () {
        return view('client.cart.checkout');
    });

    Route::get('contact-us', function () {
        return view('client.contact.contact-us');
    });

    Route::get('all-product', function () {
        return view('client.shop.shop');
    });

    Route::get('product-detail', function () {
        return view('client.shop.shop-detail');
    });

    Route::get('wishlist', function () {
        return view('client.wishlist.wishlist');
    });

    Route::prefix('my-account')->group(function () {
        Route::get('/', function () {
            return view('client.my-account.my-account');
        });
        Route::get('my-order', function () {
            return view('client.my-account.my-order');
        });
        Route::get('my-info', function () {
            return view('client.my-account.my-info');
        });
    });
});
