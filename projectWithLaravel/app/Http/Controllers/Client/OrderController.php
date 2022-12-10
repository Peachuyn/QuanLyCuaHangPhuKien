<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $donhangs = DB::table('donhang')->get()->where('KhachHangID', Auth::guard('khachhang')->user()->id);
        $chitietdonhangs = array();
        foreach ($donhangs as $donhang) {
            $chitietdonhang = DB::table('chitiet_donhang')
                ->join('sanpham', 'chitiet_donhang.SanPhamID', '=', 'sanpham.SanPhamID')
                ->select('chitiet_donhang.*', 'sanpham.SanPhamTen', 'sanpham.Gia', 'sanpham.HinhAnh')->get()
                ->where('DonHangID', $donhang->DonHangID);
            array_push($chitietdonhangs, $chitietdonhang);
        }
        // dd($donhangs, $chitietdonhangs);
        return view('client.my-account.my-order', ['donhangs' => $donhangs, 'chitietdonhangs' => $chitietdonhangs]);
    }
}
