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
                ->select('giohang_chitiet.*', 'sanpham.SanPhamTen', 'sanpham.HinhAnh', 'sanpham.Gia')
                ->where('GioHangID', $giohangID->GioHangID)
                ->get();
            // $products = DB::table('giohang_chitiet')
            //     ->select(DB::raw('sum(ThanhTien) as `TongTien`'), DB::raw('KhachHangID') 
            //     ->groupby('KhachHangID')
            //     ->get();
        } else {
            $products = array();
        }
        // dd($products);
        return view('client.cart.cart', ['products' => $products]);
    }
}
