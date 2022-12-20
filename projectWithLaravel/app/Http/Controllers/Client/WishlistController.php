<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

session_start();
class  WishlistController extends Controller
{
    public function list()
    {


        if (DB::table('wishlist')
            ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
            ->exists()
        ) {
            $wishlistID = DB::table('wishlist')
                ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
                ->first();
            $products = DB::table('wishlist_chitiet')
                ->join('sanpham', 'sanpham.SanPhamID', '=', 'wishlist_chitiet.SanPhamID')
                ->where('WishlistID', $wishlistID->WishlistID)
                ->get();
        } else {
            $products = array();
        }
        // dd($products);
        return view('client.wishlist.wishlist', ['products' => $products]);
    }
}
