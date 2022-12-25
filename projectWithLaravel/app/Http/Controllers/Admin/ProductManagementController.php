<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ProductManagementController extends Controller
{
    public function create()
    {
        $chatlieus = DB::table('chatlieu')->get();
        $menus = DB::table('menus')->get();
        return view('admin.product.add', ['title' => 'Thêm sản phẩm mới', 'chatlieus' => $chatlieus, 'menus' => $menus]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mota' => 'required',
            'gia' => 'required',
            'hinhanh' => 'required',
            'soluong' => 'required',
            'cannang' => 'required',
        ]);
        $product = array();
        $product['SanPhamTen'] = $request->name;
        $product['ChatLieuID'] = $request->chatlieu;
        $product['MoTa'] = $request->mota;
        $product['Gia'] = $request->gia;
        $product['SoLuong'] = $request->soluong;
        $product['HinhAnh'] = $request->hinhanh;
        $product['GiaCong'] = $request->giacong;
        $product['CanNang'] = $request->cannang;

        try {
            $SanPhamID = DB::table('sanpham')->insertGetId($product);
            $chitietsanpham = array();
            $chitietsanpham['PhanLoaiID'] = $request->danhmuc;
            $chitietsanpham['SanPhamID'] = $SanPhamID;
            Db::table('chitietsanpham')->insert($chitietsanpham);
            Session::flash('success', 'Thêm thành công Sản phẩm');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
        }
        return redirect()->route('admin.product.list');
    }

    public function index()
    {
        $products = DB::table('sanpham')->join('chatlieu', 'sanpham.ChatLieuID', '=', 'chatlieu.ChatLieuID')
            ->join('chitietsanpham', 'chitietsanpham.SanPhamID', '=', 'sanpham.SanPhamID')
            ->join('menus', 'menus.id', '=', 'chitietsanpham.PhanLoaiID')->get();
        return view('admin.product.list', [
            'title' => 'Danh sách sản phẩm mới nhất',
            'products' => $products,
        ]);
    }

    public function show($id)
    {
        $chatlieus = DB::table('chatlieu')->get();
        $menus = DB::table('menus')->get();
        $product = DB::table('sanpham')->join('chatlieu', 'sanpham.ChatLieuID', '=', 'chatlieu.ChatLieuID')
            ->join('chitietsanpham', 'chitietsanpham.SanPhamID', '=', 'sanpham.SanPhamID')
            ->join('menus', 'menus.id', '=', 'chitietsanpham.PhanLoaiID')
            ->where('sanpham.SanPhamID', $id)->first();

        return view('admin.product.edit', [
            'title' => 'Chỉnh sửa sản phẩm: ' . $product->SanPhamTen,
            'product' => $product,
            'chatlieus' => $chatlieus,
            'menus' => $menus
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'mota' => 'required',
            'gia' => 'required',
            'soluong' => 'required',
            'cannang' => 'required',
        ]);
        $product = array();
        $product['SanPhamTen'] = $request->name;
        $product['ChatLieuID'] = $request->chatlieu;
        $product['MoTa'] = $request->mota;
        $product['Gia'] = $request->gia;
        $product['SoLuong'] = $request->soluong;
        if (isset($request->hinhanh)) {
            $product['HinhAnh'] = $request->hinhanh;
        }
        $product['GiaCong'] = $request->giacong;
        $product['CanNang'] = $request->cannang;
        try {
            DB::table('sanpham')->where('sanpham.SanPhamID', $id)->update($product);
            $chitietsanpham = array();
            $chitietsanpham['PhanLoaiID'] = $request->danhmuc;
            Db::table('chitietsanpham')->where('chitietsanpham.SanPhamID', $id)->update($chitietsanpham);
            Session::flash('success', 'Chỉnh sửa thành công Sản phẩm');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
        }
        return redirect()->route('admin.product.list');
    }

    public function destroy(Request $request)
    {
        $id = (int) $request->input('id');
        $product = DB::table('sanpham')->where('sanpham.SanPhamID', $id)->first();
        if ($product) {
            try {
                DB::table('chitietsanpham')->where('chitietsanpham.SanPhamID', $id)->delete();
                DB::table('sanpham')->where('sanpham.SanPhamID', $id)->delete();
                return response()->json(['error' => false, 'message' => 'Xóa thành công sản phẩm']);
            } catch (\Exception $err) {
                return response()->json([
                    'error' => true,
                    'message' => 'Không thể xóa sản phẩm do tồn tại ở các bảng khác',
                ]);
            }
        }
        return response()->json([
            'error' => true,
            'message' => 'Xóa không thành công',
        ]);
    }

    public function search(Request $request)
    {
        $data = $request->input('data');
        $products = DB::table('sanpham')
            ->join('chatlieu', 'sanpham.ChatLieuID', '=', 'chatlieu.ChatLieuID')
            ->where('SanPhamTen', 'like', '%' . $data . '%')
            ->get();
        $result = "";
        foreach ($products as $product) {
            $giacong = "";
            if ($product->GiaCong == 0) {
                $giacong = 'Có sẵn';
            } else $giacong = 'Thiết kế theo yêu cầu';
            $result .=
                "<tr>
                <td>$product->SanPhamID</td>
                <td><img style='width: 50px;' src='/template/admin/images/SanPhamBellezza/SanPham/$product->HinhAnh'></td>
                <td>$product->SanPhamTen</td>
                <td>$product->ChatLieu_Ten</td>
                <td>$product->Gia</td>
                <td>$product->SoLuong</td>
                <td>$product->SoLuong_Ban</td>
                <td>$giacong</td>
                <td>$product->CanNang</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='/admin/products/edit/$product->SanPhamID'>
                        <i class='fas fa-edit'></i>
                    </a>
                    <a href='#' class='btn btn-danger btn-sm' onclick=\"removeRow('$product->SanPhamID', '/admin/products/destroy')\">
                        <i class='fas fa-trash'></i>
                    </a>
                </td>
              </tr>";
        };
        return response()->json($result);
    }
}
