<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
// mysqli_set_charset($con,"utf8");
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
    // DANG LAM PDF
    public function print($checkout_code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf -> loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code)
    {
        $customerid=DB::table('donhang')->where('DonHangID',$checkout_code)->first(); 
        $customer=DB::table('khachhang')->where('id',$customerid->KhachHangID)->first();
        $products=DB::table('chitiet_donhang')->join('sanpham','chitiet_donhang.SanPhamID','sanpham.SanPhamID')->select('chitiet_donhang.*','sanpham.SanPhamTen','sanpham.Gia')->where('DonHangID',$checkout_code)->get();

        $chitietdonhang = '';
        foreach($products as $product){
            $chitietdonhang.= '<tr>
            <th>'.$product->SanPhamTen.'</th>
            <th>'.$customerid->GiaShip.'</th>
            <th>'.$product->SoLuong.'</th>
            <th>'.$product->Gia.'</th>
            <th>'.$product->Gia*$product->SoLuong.'</th>
        </tr>';

        };
        return '
        <h1><center>BILL OF SALE</center></h1>
        <table border="1">

            <tr>
                <th>Customer name </th>
                <th> Address</th>
                <th>Phonenumber</th>
                <th>Email</th>
            </tr>
            <tr>
                <td>'.$customer->TenKhachHang.'</td>
                <td>'.$customer->DiaChi.'</td>
                <td>'.$customer->SoDienThoai.'</td>
                <td>'.$customer->email.'</td>
            </tr>
       
    </table>
    <p>Your order list</p>
    <table border="1">
        <tr>
            <th>Product name</th>
            <th>Shipping fee</th>
            <th>Quantity</th>
            <th>Product price</th>
            <th>Amount</th>
        </tr>
        
        '.$chitietdonhang.'
        <tr>
            <td colspan="5">
                <p>Shipping fee:'.$customerid->GiaShip.'</p>
                <p>Total: '.$customerid->TongTien.'</p>
            </td>
            
        </tr>
    
    </table>
    <p>Sign</p>
    <table>
        <thead>
            <tr>
                <th width="200px">Invoice maker</th>
                <th width="800px">Customer</th>
            </tr>
        </thead>
    </table>
    ';

    }
}
 