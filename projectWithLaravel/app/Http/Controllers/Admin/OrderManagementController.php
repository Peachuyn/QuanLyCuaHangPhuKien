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
            ->join('tinh', 'tinh.TinhID', '=', 'donhang.TinhID')
            ->join('quan', 'quan.QuanID', '=', 'donhang.QuanID')
            ->select('donhang.*', 'khachhang.TenKhachHang', 'tinh.*', 'quan.*')
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
            ->join('tinh', 'tinh.TinhID', '=', 'donhang.TinhID')
            ->join('quan', 'quan.QuanID', '=', 'donhang.QuanID')
            ->select('donhang.*', 'khachhang.TenKhachHang', 'tinh.*', 'quan.*')
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

    public function search(Request $request)
    {
        $data = $request->input('data');
        $donhangs = DB::table('donhang')
            ->join('khachhang', 'khachhang.id', '=', 'donhang.KhachHangID')
            ->join('tinh', 'tinh.TinhID', '=', 'donhang.TinhID')
            ->join('quan', 'quan.QuanID', '=', 'donhang.QuanID')
            ->select('donhang.*', 'khachhang.TenKhachHang', 'tinh.*', 'quan.*')
            ->where('TenKhachHang', 'like', '%' . $data . '%')
            ->get();
        $result = "";
        foreach ($donhangs as $order) {
            $progress = "";
            $status = "";
            if ($order->DonHang_TinhTrang == 0) {
                $status = "Đơn hàng mới";
                $progress = "<div class='progress progress-sm'>
                <div class='progress-bar bg-green' role='progressbar' aria-valuenow='30' aria-valuemin='0' aria-valuemax='100' style='width: 30%'>
                </div>
              </div>
              <small>
                30% Complete
            </small>";
            } elseif ($order->DonHang_TinhTrang == 1) {
                $status = "Đơn hàng đang được giao";
                $progress = "<div class='progress progress-sm'>
                <div class='progress-bar bg-green' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 60%'>
                </div>
              </div>
              <small>
                60% Complete
            </small>";
            } elseif ($order->DonHang_TinhTrang == 2) {
                $status = "Đơn hàng đã hoàn thành";
                $progress = "<div class='progress progress-sm'>
                <div class='progress-bar bg-green' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>
                </div>
              </div>
              <small>
                100% Complete
            </small>";
            } else {
                $status = "Đơn hàng đã hủy";
                $progress = "<div class='progress progress-sm'>
                <div class='progress-bar bg-red' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>
                </div>
              </div>
              <small>
                Cancel
            </small>";
            }

            $result .= "
            <tr>
            <td>$order->DonHangID</td>
            <td>$order->TenKhachHang</td>
            <td class='project_progress'>
                $progress
            </td>
            <td>
            $status
            </td>
            <td>$order->GiaShip</td>
            <td>$order->TongTien</td>
            <td>$order->DiaChi, $order->TenQuan, $order->TenTinh</td>
            <td>$order->ThoiGianTao</td>
            <td>
                <a class='btn btn-primary btn-sm' href='/admin/orders/edit/$order->DonHangID'>
                    <i class='fas fa-edit'></i>
                </a>
            </td>
          </tr>";
        };
        return response()->json($result);
    }
}
