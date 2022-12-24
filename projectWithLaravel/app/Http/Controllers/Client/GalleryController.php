<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function index()
    {
        $product = DB::table('sanpham')
            ->join('chitietsanpham', 'sanpham.SanPhamID', '=', 'chitietsanpham.SanPhamID')
            ->join('menus', 'chitietsanpham.PhanLoaiID', '=', 'menus.id')
            ->inRandomOrder()->limit(12)->get();

        return view('client.gallery.gallery', ['products' => $product]);
    }
}
