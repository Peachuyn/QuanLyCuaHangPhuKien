<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search(Request $request)
    {

        $products = DB::table('sanpham')
            ->join('chitietsanpham', 'sanpham.SanPhamID', '=', 'chitietsanpham.SanPhamID')
            ->join('menus', 'menus.id', '=', 'chitietsanpham.PhanLoaiID')
            ->where('SanPhamTen', 'like', '%' . $request->input('query') . '%')
            ->get();
        $count = $products->count();
        $categories = DB::table('menus')->get();
        return view('client.shop.search', ['products' => $products, 'categories' => $categories, 'count' => $count]);
    }

    public function get_add_to_cart(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $data = array();
        $GioHangID = DB::table('giohang')
            ->select('GioHangID')
            ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
            ->get();

        //KhachHang chua co gio hang
        if (count($GioHangID) === 0) {
            //Tạo giỏ hàng
            $GioHang = array();
            $GioHang['KhachHangID'] = Auth::guard('khachhang')->user()->id;
            DB::table('giohang')->insert($GioHang);

            //Tao giỏ hàng chi tiết
            $GioHangID = DB::table('giohang')
                ->select('GioHangID')
                ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
                ->get();
            $data['GioHangID'] = $GioHangID[0]->GioHangID;
            $data['SanPhamID'] = $request->product_id;
            $data['SoLuong'] = $product_qty;
            $GiaSanPham = DB::table('sanpham')->select('Gia')->where('SanPhamID', $request->product_id)->get();
            $data['ThanhTien'] = $GiaSanPham[0]->Gia * $product_qty;
            DB::table('giohang_chitiet')->insert($data);

            //Sửa giỏ hàng

            $GioHangUpdate = array();
            $GioHangUpdate['SoLuong'] = $product_qty;
            $GioHangUpdate['TongTien'] = $GiaSanPham[0]->Gia * $product_qty;
            DB::table('giohang')->where('KhachHangID', Auth::guard('khachhang')->user()->id)->update($GioHangUpdate);
        }
        //KhachHang da co gio hang
        else {
            //Check sản phẩm đã thêm chưa
            $product_check = DB::table('giohang_chitiet')->where('GioHangID', $GioHangID[0]->GioHangID)
                ->where('SanPhamID', $request->product_id)
                ->exists();
            //------------->Thêm rồi
            if ($product_check) {
                //Sửa giỏ hàng chi tiết
                $GioHangCT_Cu = DB::table('giohang_chitiet')->where('GioHangID', $GioHangID[0]->GioHangID)
                    ->where('SanPhamID', $request->product_id)->first();
                $GiaSanPham = DB::table('sanpham')->select('Gia')->where('SanPhamID', $request->product_id)->get();
                $data['SoLuong'] = $GioHangCT_Cu->SoLuong + $product_qty;
                $data['ThanhTien'] = $GioHangCT_Cu->ThanhTien + $GiaSanPham[0]->Gia * $product_qty;
                DB::table('giohang_chitiet')->where('GioHangID', $GioHangID[0]->GioHangID)
                    ->where('SanPhamID', $request->product_id)->update($data);
            }
            // ------------->Chưa thêm
            else {
                //Tao giỏ hàng chi tiết
                $data['GioHangID'] = $GioHangID[0]->GioHangID;
                $data['SanPhamID'] = $request->product_id;
                $data['SoLuong'] = $product_qty;
                $GiaSanPham = DB::table('sanpham')->select('Gia')->where('SanPhamID', $request->product_id)->get();
                $data['ThanhTien'] = $GiaSanPham[0]->Gia * $product_qty;
                DB::table('giohang_chitiet')->insert($data);
            }

            //Sửa giỏ hàng
            $GioHangUpdate = array();
            $GioHangCu = DB::table('giohang')
                ->select('SoLuong', 'TongTien')
                ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
                ->get();
            $GioHangUpdate['SoLuong'] = $GioHangCu[0]->SoLuong + $product_qty;
            $GioHangUpdate['TongTien'] = $GioHangCu[0]->TongTien + $GiaSanPham[0]->Gia * $product_qty;
            $GioHang = DB::table('giohang')->where('KhachHangID', Auth::guard('khachhang')->user()->id)->update($GioHangUpdate);
        }
        //Lấy data
        $cart_detail = DB::table('giohang_chitiet')
            ->join('sanpham', 'giohang_chitiet.SanPhamID', '=', 'sanpham.SanPhamID')
            ->select('giohang_chitiet.*', 'sanpham.SanPhamTen', 'sanpham.HinhAnh')
            ->where('GioHangID', '=', $GioHangID[0]->GioHangID)
            ->where('giohang_chitiet.SanPhamID', '=', $request->product_id)
            ->get();
        $cart = DB::table('giohang')
            ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
            ->get();
        return response()->json(['GioHangCT' => $cart_detail, 'GioHang' => $cart, 'quantity' => $product_qty]);
    }

    public function add_wishlist(Request $request)
    {
        $product_id = $request->product_id;
        $data = array();
        $Wishlist = DB::table('wishlist')
            ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
            ->get();

        //Khách hàng chưa có Wishlist
        if (count($Wishlist) === 0) {

            //Tạo Wishlist
            $Wishlist = array();
            $Wishlist['KhachHangID'] = Auth::guard('khachhang')->user()->id;
            DB::table('wishlist')->insert($Wishlist);

            //Tạo Wishlist chi tiết
            $WishlistID = DB::table('wishlist')
                ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
                ->first();
            $data['WishlistID'] = $WishlistID->WishlistID;
            $data['SanPhamID'] = $product_id;
            DB::table('wishlist_chitiet')->insert($data);
        }
        //Khách hàng đã có Wishlist
        else {

            //Check sản phẩm đã được thêm vào wishlist chưa
            $product_check = DB::table('wishlist_chitiet')->where('SanPhamID', $product_id)
                ->where('WishlistID', $Wishlist[0]->WishlistID)
                ->exists();

            //-----------Được thêm rồi
            if ($product_check) {
                return response()->json(['status' => 'Bạn đã từng thêm sản phẩm vào wishlist trước đó rồi']);
            }
            //-----------Chưa thêm
            else {
                $data['WishlistID'] = $Wishlist[0]->WishlistID;
                $data['SanPhamID'] = $product_id;
                DB::table('wishlist_chitiet')->insert($data);
            }
        }
        return response()->json(['status' => 'Tạo xong wishlist']);
    }

    public function del_wishlist(Request $request)
    {
        $id = $request->product_id;
        $Wishlist = DB::table('wishlist')
            ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
            ->first();
        DB::table('wishlist_chitiet')->where('SanPhamID', $id)
            ->where('WishlistID', $Wishlist->WishlistID)
            ->delete();
        return response()->json(['product_id' => $id]);
    }

    public function del_cart(Request $request)
    {
        $id = $request->product_id;
        //Xoa giohang_chitiet
        $cart = DB::table('giohang')
            ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
            ->first();
        $cart_detail = DB::table('giohang_chitiet')
            ->where('GioHangID', '=', $cart->GioHangID)
            ->where('giohang_chitiet.SanPhamID', '=', $id)
            ->first();
        $product_qty = $cart_detail->SoLuong;
        $thanhtien = $cart_detail->ThanhTien;
        //Cap nhat lai gio hang sau khi del
        $GioHangUpdate = array();
        $GioHangUpdate['SoLuong'] = $cart->SoLuong - $product_qty;
        $GioHangUpdate['TongTien'] = $cart->TongTien - $thanhtien;
        DB::table('giohang')->where('KhachHangID', Auth::guard('khachhang')->user()->id)->update($GioHangUpdate);
        //Del
        $cart_detail = DB::table('giohang_chitiet')
            ->where('GioHangID', '=', $cart->GioHangID)
            ->where('giohang_chitiet.SanPhamID', '=', $id)
            ->delete();
        //Lay data
        $cart_final = DB::table('giohang')
            ->where('KhachHangID', Auth::guard('khachhang')->user()->id)
            ->first();
        return response()->json(['product_id' => $id, 'cart' => $cart_final]);
    }
}
