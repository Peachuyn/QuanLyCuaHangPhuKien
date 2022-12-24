<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $product = DB::table('sanpham')
            ->join('chitietsanpham', 'sanpham.SanPhamID', '=', 'chitietsanpham.SanPhamID')
            ->join('menus', 'chitietsanpham.PhanLoaiID', '=', 'menus.id')
            ->inRandomOrder()->limit(4)->get();

        return view('client.home.home', ['products' => $product]);
    }
}
