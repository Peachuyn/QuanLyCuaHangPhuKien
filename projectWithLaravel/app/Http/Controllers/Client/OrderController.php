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
            $chitietdonhang = DB::table('chitiet_donhang')->get()->where('DonHangID', $donhang->DonHangID);
            array_push($chitietdonhangs, $chitietdonhang);
        }
        return view('client.my-account.my-order', ['donhangs' => $donhangs, 'chitietdonhangs' => $chitietdonhangs]);
    }
}
