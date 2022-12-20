<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

session_start();
class CartController extends Controller
{
    public function gh()
    {


        if (DB::table('giohang')
            ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
            ->exists()
        ) {
            $giohangID = DB::table('giohang')
                ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
                ->first();
            $products = DB::table('giohang_chitiet')
                ->join('sanpham', 'sanpham.SanPhamID', '=', 'giohang_chitiet.SanPhamID')
                ->where('GioHangID', $giohangID->GioHangID)
                ->get();
        } else {
            $products = array();
        }
        // dd($products);
        return view('client.cart.cart', ['products' => $products]);
    }
}
