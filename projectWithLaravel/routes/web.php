<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\LoginController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\MenuController;
use \App\Http\Controllers\Admin\SupplierController;
use \App\Http\Controllers\Admin\OrderManagementController;
use \App\Http\Controllers\Admin\ProductManagementController;
use \App\Http\Controllers\Admin\CustomerController;
use \App\Http\Controllers\Admin\StatisticController;

use \App\Http\Controllers\Admin\NhanVienController;

use \App\Http\Controllers\Client\OrderController;
use \App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\SearchController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\GalleryController;
use App\Http\Controllers\Client\WishlistController;
use App\Http\Controllers\Client\CartController;



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

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/', [MainController::class, 'index'])->name('home');
        Route::get('main', [MainController::class, 'index']);


        #Menu
        Route::middleware('can:isQuanLy')->group(function () {
            Route::prefix('menus')->group(function () {
                Route::get('add', [MenuController::class, 'create'])->middleware('can:isQuanLy');
                Route::post('add', [MenuController::class, 'store']);
                Route::get('list', [MenuController::class, 'index']);
                Route::get('edit/{menu}', [MenuController::class, 'show']);
                Route::post('edit/{menu}', [MenuController::class, 'update']);

                Route::delete('destroy', [MenuController::class, 'destroy']);
            });
        });

        #NhanVien
        Route::middleware('can:isQuanLy')->group(function () {
            Route::prefix('nhanvien')->name('nhanvien.')->group(function () {
                Route::get('add', [NhanVienController::class, 'create']);
                Route::post('add', [NhanVienController::class, 'store']);
                // Route::post('add', [MenuController::class, 'store']);
                Route::get('list', [NhanVienController::class, 'index'])->name('list');
                Route::get('edit/{nhanvien}', [NhanVienController::class, 'show']);
                Route::post('edit/{nhanvien}', [NhanVienController::class, 'update']);
                Route::delete('destroy', [NhanVienController::class, 'destroy']);
                Route::get('search', [NhanVienController::class, 'search']);
            });
        });

        #Product
        Route::middleware('can:isKho')->group(function () {
            Route::prefix('products')->name('product.')->group(function () {
                Route::get('add', [ProductManagementController::class, 'create']);
                Route::post('add', [ProductManagementController::class, 'store']);
                Route::get('edit/{product}', [ProductManagementController::class, 'show']);
                Route::post('edit/{product}', [ProductManagementController::class, 'update']);
                Route::get('list', [ProductManagementController::class, 'index'])->name('list');
                Route::delete('destroy', [ProductManagementController::class, 'destroy']);
                Route::get('search', [ProductManagementController::class, 'search']);
            });
        });

        #NhaCungCap
        Route::middleware(['can:isKhoAndQuanLy'])->group(function () {
            Route::prefix('suppliers')->name('supplier.')->group(function () {
                Route::get('add', [SupplierController::class, 'create']);
                Route::post('add', [SupplierController::class, 'store']);
                Route::get('list', [SupplierController::class, 'index'])->name('list');
                Route::get('edit/{supplier}', [SupplierController::class, 'show']);
                Route::post('edit/{supplier}', [SupplierController::class, 'update']);

                Route::delete('destroy', [SupplierController::class, 'destroy']);
                Route::get('search', [SupplierController::class, 'search']);
            });
        });
        #ThongKe
        Route::middleware(['can:isQuanLyAndBanHang'])->group(function () {
            Route::prefix('statistics')->name('statistic.')->group(function () {
                Route::get('cost', [StatisticController::class, 'listcost'])->name('cost');
                Route::get('revenue', [StatisticController::class, 'listrevenue'])->name('revenue');
                Route::get('thongke', [StatisticController::class, 'thongke']);
                Route::get('thongkecp', [StatisticController::class, 'thongkecp']);
            });
        });
       
        #DonHang
        Route::middleware(['can:isKhoAndBanHang'])->group(function () {
            Route::prefix('orders')->name('order.')->group(function () {
                Route::get('list', [OrderManagementController::class, 'index'])->name('list');
                Route::get('edit/{supplier}', [OrderManagementController::class, 'show']);
                Route::post('edit/{supplier}', [OrderManagementController::class, 'update']);
                Route::get('search', [OrderManagementController::class, 'search']);
                 //DANG LAM PDF
                 Route::get('print/{checkout_code}', [OrderManagementController::class, 'print']);
            });
        });
        
        #KhachHang
        Route::middleware(['can:isBanHangAndCSKH'])->group(function () {
            Route::prefix('customer')->name('customer.')->group(function () {
                Route::get('list', [CustomerController::class, 'index'])->name('list');
                Route::get('edit/{customer}', [CustomerController::class, 'show']);
                Route::post('edit/{customer}', [CustomerController::class, 'update']);
                Route::get('search', [CustomerController::class, 'search']);
            });
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

        Route::get('gallery', [GalleryController::class, 'index'])->name('gallery');

        Route::get('about-us', function () {
            return view('client.about.about-us');
        })->name('about-us');

        Route::get('cart', [CartController::class, 'gh'])->name('cart');
        Route::get('del_cart/{id}', [SearchController::class, 'del_cart'])->name('del_cart');

        Route::get('checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('CheckProductQuantity');
        Route::post('checkout', [CartController::class, 'postcheckout']);

        Route::get('contact-us', function () {
            return view('client.contact.contact-us');
        })->name('contact-us');

        Route::get('all-product', [ProductController::class, 'getAll'])->name('all-product');
        Route::get('search', [SearchController::class, 'search'])->name('search');
        Route::get('add_to_cart/{id}', [SearchController::class, 'get_add_to_cart'])->name('get_add_to_cart');
        Route::get('category/{id}', [ProductController::class, 'viewCategory'])->name('category');
        Route::get('product-detail/{id}', [ProductController::class, 'getOne'])->name('product-detail');

        Route::get('wishlist', [WishlistController::class, 'list'])->name('wishlist');

        Route::get('add_wishlist/{id}', [SearchController::class, 'add_wishlist'])->name('add_wishlist');
        Route::get('del_wishlist/{id}', [SearchController::class, 'del_wishlist'])->name('del_wishlist');


        Route::prefix('my-account')->group(function () {
            Route::get('/', function () {
                return view('client.my-account.my-account');
            })->name('my-account');
            Route::get('my-order', [OrderController::class, 'index'])->name('my-order');
            Route::get('my-info', [ClientController::class, 'view'])->name('my-info');
            Route::post('my-info', [ClientController::class, 'edit']);
        });
        route::get('forget-pass', function () {
            return view('client.my-account.forget-pass');
        });
    });
});
