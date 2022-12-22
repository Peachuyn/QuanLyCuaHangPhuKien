<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderManagementController extends Controller
{
    public function index()
    {
        $orders = DB::table('donhang')
            ->join('khachhang', 'khachhang.id', '=', 'donhang.KhachHangID')
            ->join('users', 'users.id', '=', 'donhang.UserID')
            ->get();
        // dd($orders);
        return view('admin.order.list', [
            'title' => 'Danh sách đơn hàng mới nhất',
            'orders' => $orders,
        ]);
    }
}
