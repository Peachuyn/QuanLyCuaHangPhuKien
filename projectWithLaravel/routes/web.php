<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\LoginController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\MenuController;
use \App\Http\Controllers\Admin\SupplierController;
use \App\Http\Controllers\Client\OrderController;
use \App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\SearchController;
use App\Http\Controllers\Client\HomeController;


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



Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {
        Route::get('users/login', [LoginController::class, 'index'])->name('login');
        Route::post('users/login/store', [LoginController::class, 'store']);
    });
    Route::middleware(['auth:web', 'PreventBackHistory'])->group(function () {


        Route::get('/', [MainController::class, 'index'])->name('home');
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

        #NhaCungCap
        Route::prefix('suppliers')->name('supplier.')->group(function () {
            Route::get('add', [SupplierController::class, 'create']);
            Route::post('add', [SupplierController::class, 'store']);
            Route::get('list', [SupplierController::class, 'index'])->name('list');
            Route::get('edit/{supplier}', [SupplierController::class, 'show']);
            Route::post('edit/{supplier}', [SupplierController::class, 'update']);

            Route::delete('destroy', [SupplierController::class, 'destroy']);
        });
    });
});
// ----------------------------Khach hang--------------------------------


Route::prefix('shop')->name('client.')->group(function () {
    Route::middleware(['guest:khachhang', 'PreventBackHistory'])->group(function () {
        Route::get('login', [ClientController::class, 'getLogin'])->name('login');
        Route::post('login', [ClientController::class, 'postLogin']);
        Route::get('register', [ClientController::class, 'getRegister'])->name('register');
        Route::post('register', [ClientController::class, 'postRegister']);
    });
    Route::middleware(['auth:khachhang', 'PreventBackHistory'])->group(function () {
        Route::get('home', [HomeController::class, 'index'])->name('home');

        Route::post('/logout', [ClientController::class, 'logout'])->name('logout');

        Route::get('gallery', function () {
            return view('client.gallery.gallery');
        })->name('gallery');

        Route::get('about-us', function () {
            return view('client.about.about-us');
        })->name('about-us');

        Route::get('cart', function () {
            return view('client.cart.cart');
        })->name('cart');

        Route::get('checkout', function () {
            return view('client.cart.checkout');
        })->name('checkout');

        Route::get('contact-us', function () {
            return view('client.contact.contact-us');
        })->name('contact-us');

        Route::get('all-product', [ProductController::class, 'getAll'])->name('all-product');
        Route::get('search', [SearchController::class, 'search'])->name('search');
        Route::get('add_to_cart/{id}', [SearchController::class, 'get_add_to_cart'])->name('get_add_to_cart');
        Route::get('category/{id}', [ProductController::class, 'viewCategory'])->name('category');
        Route::get('product-detail/{id}', [ProductController::class, 'getOne'])->name('product-detail');

        Route::get('wishlist', function () {
            return view('client.wishlist.wishlist');
        })->name('wishlist');

        Route::get('add_wishlist/{id}', [SearchController::class, 'add_wishlist'])->name('add_wishlist');

        Route::prefix('my-account')->group(function () {
            Route::get('/', function () {
                return view('client.my-account.my-account');
            })->name('my-account');
            Route::get('my-order', [OrderController::class, 'index'])->name('my-order');
            Route::get('my-info', [ClientController::class, 'view'])->name('my-info');
            Route::post('my-info', [ClientController::class, 'edit']);
        });
    });
});
