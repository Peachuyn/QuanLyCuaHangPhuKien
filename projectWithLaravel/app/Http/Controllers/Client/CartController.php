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
            $cart = DB::table('giohang')->where('KhachHangID', Auth::guard('khachhang')->user()->id)->first();
        } else {
            $products = array();
            $cart = DB::table('giohang')->where('KhachHangID', Auth::guard('khachhang')->user()->id)->first();
        }

        return view('client.cart.cart', ['products' => $products, 'cart' => $cart]);
    }

    public function checkout()
    {
        //Lấy khách hàng
        $customer = Auth::guard('khachhang')->user();
        //Lấy tỉnh, quận, cart
        $tinh = DB::table('tinh')->get();
        $quan = DB::table('quan')->get();
        $cart = DB::table('giohang')->where('KhachHangID', Auth::guard('khachhang')->user()->id)->first();
        $cart_details = DB::table('giohang_chitiet')
            ->join('sanpham', 'sanpham.SanPhamID', '=', 'giohang_chitiet.SanPhamID')
            ->select('giohang_chitiet.*', 'sanpham.SanPhamTen', 'sanpham.HinhAnh', 'sanpham.Gia')
            ->where('GioHangID', $cart->GioHangID)
            ->get();
        return view(
            'client.cart.checkout',
            ['customer' => $customer, 'quans' => $quan, 'tinhs' => $tinh, 'cart' => $cart, 'cart_details' => $cart_details]
        );
    }

    public function postcheckout(Request $request)
    {
        $giohang = DB::table('giohang')
            ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
            ->first();
        $cart_details = DB::table('giohang_chitiet')
            ->where('GioHangID', '=', $giohang->GioHangID)
            ->get();
        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);
        //Tao don hang
        $DonHang = array();
        $DonHang['KhachHangID'] = Auth::guard('khachhang')->user()->id;
        $DonHang['GiaShip'] = $request->shipping_option;
        $DonHang['TongTien'] = $giohang->TongTien + $request->shipping_option;
        $DonHang['DiaChi'] = $request->address;
        $DonHang['TinhID'] = $request->tinh;
        $DonHang['QuanID'] = $request->quan;
        $DonHang['DonHang_TinhTrang'] = 0;
        $donhangId = DB::table('donhang')->insertGetId($DonHang);
        //Tao don hang chi tiet
        foreach ($cart_details as $cart_detail) {
            $ChiTietDonHang = array();
            $ChiTietDonHang['DonHangID'] = $donhangId;
            $ChiTietDonHang['SanPhamID'] = $cart_detail->SanPhamID;
            $ChiTietDonHang['SoLuong'] = $cart_detail->SoLuong;
            DB::table('chitiet_donhang')->insert($ChiTietDonHang);
        }
        //Cap nhat so luong san pham
        foreach ($cart_details as $cart_detail) {
            $product_old = DB::table('sanpham')->where('sanpham.SanPhamID', $cart_detail->SanPhamID)->first();
            $product = array();
            $product['SoLuong'] = $product_old->SoLuong - $cart_detail->SoLuong;
            $product['SoLuong_Ban'] = $product_old->SoLuong_Ban + $cart_detail->SoLuong;
            DB::table('sanpham')->where('sanpham.SanPhamID', $cart_detail->SanPhamID)->update($product);
        }
        //Xoa cart and cart_detail
        foreach ($cart_details as $cart_detail) {
            DB::table('giohang_chitiet')->where('GioHangChiTietID', $cart_detail->GioHangChiTietID)->delete();
        }
        $giohang = DB::table('giohang')
            ->where('KhachHangID', Auth::guard('khachhang')->user()->id)->delete();
        return redirect()->route('client.my-order')->with('success', 'Đặt đơn hàng thành công');
    }
}
