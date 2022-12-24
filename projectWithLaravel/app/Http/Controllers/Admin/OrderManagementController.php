<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
            ->join('tinh', 'tinh.TinhID', '=', 'donhang.TinhID')
            ->join('quan', 'quan.QuanID', '=', 'donhang.QuanID')
            ->select('donhang.*', 'khachhang.TenKhachHang', 'users.name', 'tinh.*', 'quan.*')
            ->get();
        return view('admin.order.list', [
            'title' => 'Danh sách đơn hàng mới nhất',
            'orders' => $orders,
        ]);
    }

    public function show($id)
    {
        $donhang = DB::table('donhang')
            ->join('khachhang', 'khachhang.id', '=', 'donhang.KhachHangID')
            ->join('users', 'users.id', '=', 'donhang.UserID')
            ->join('tinh', 'tinh.TinhID', '=', 'donhang.TinhID')
            ->join('quan', 'quan.QuanID', '=', 'donhang.QuanID')
            ->select('donhang.*', 'khachhang.TenKhachHang', 'users.name', 'tinh.*', 'quan.*')
            ->where('DonHangID', $id)->first();
        return view('admin.order.edit', [
            'title' => 'Chỉnh sửa đơn hàng: #' . $donhang->DonHangID,
            'donhang' => $donhang,
        ]);
    }

    public function update(Request $request, $id)
    {
        $donhang = DB::table('donhang')->where('DonHangID', $id)->first();
        $donhang = array();
        $donhang['DonHang_TinhTrang'] = $request->trangthai;
        try {
            DB::table('donhang')->where('DonHangID', $id)->update($donhang);
            Session::flash('success', 'Chỉnh sửa thành công trạng thái Đơn hàng');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
        }
        return redirect()->route('admin.order.list');
    }
}
