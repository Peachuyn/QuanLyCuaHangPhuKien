<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if (Auth::guard('khachhang')->check()) {
                $GioHangID = DB::table('giohang')
                    ->select('GioHangID')
                    ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
                    ->get();
                $product_images = DB::table('sanpham')->inRandomOrder()->limit(10)->get();
                if (DB::table('giohang')->where('KhachHangID', Auth::guard('khachhang')->user()->id)->exists()) {
                    $GioHangCTs = DB::table('giohang_chitiet')
                        ->join('sanpham', 'giohang_chitiet.SanPhamID', '=', 'sanpham.SanPhamID')
                        ->select('sanpham.SanPhamTen', 'sanpham.SanPhamID', 'giohang_chitiet.SoLuong', 'sanpham.HinhAnh', 'giohang_chitiet.ThanhTien', 'giohang_chitiet.GioHangChiTietID')
                        ->where('GioHangID', $GioHangID[0]->GioHangID)
                        ->get();
                    $GioHang = DB::table('giohang')->where('GioHangID', $GioHangID[0]->GioHangID)
                        ->get();
                    $view->with('GioHangCT_floats', $GioHangCTs)
                        ->with('GioHang_float', $GioHang[0])
                        ->with('product_insta', $product_images);
                } else {
                    $view->with('product_insta', $product_images);
                }
            }
        });
    }
}
