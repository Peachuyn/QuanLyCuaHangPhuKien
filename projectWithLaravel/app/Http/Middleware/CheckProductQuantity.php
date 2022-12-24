<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckProductQuantity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $cart = DB::table('giohang')
            ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
            ->first();
        $cart_details = DB::table('giohang_chitiet')
            ->where('GioHangID', '=', $cart->GioHangID)
            ->get();
        // dd($cart_details);
        foreach ($cart_details as $cart_detail) {
            $stock = DB::table('sanpham')
                ->where('SanPhamID', '=', $cart_detail->SanPhamID)
                ->first();
            if ($cart_detail->SoLuong > $stock->SoLuong) {
                return redirect()
                    ->route('client.cart')
                    ->with('error', 'Sản phẩm ' . $stock->SanPhamTen . ' chỉ còn ' . $stock->SoLuong . ' cái trong kho, không đủ số lượng để đặt hàng');
            };
        }
        return $next($request);
    }
}
