<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = DB::table('nhacungcap')->get();
        return view('admin.supplier.list', [
            'title' => 'Danh sách nhà cung cấp mới nhất',
            'suppliers' => $suppliers,
        ]);
    }

    public function create()
    {
        return view('admin.supplier.add', [
            'title' => 'Thêm nhà cung cấp mới',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sdt' => 'required|numeric|digits_between:10,11|unique:nhacungcap,SoDienThoai',
            'email' => 'required|email|unique:nhacungcap,Email',
            'nganhhang' => 'required',
        ]);
        $suppliers = array();
        $suppliers['TenNhaCungCap'] = $request->name;
        $suppliers['SoDienThoai'] = $request->sdt;
        $suppliers['Email'] = $request->email;
        $suppliers['NganhHang'] = $request->nganhhang;
        try {
            DB::table('nhacungcap')->insert($suppliers);
            Session::flash('success', 'Thêm thành công Danh mục');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
        }
        return redirect()->back();
    }

    public function show($id)
    {
        $supplier = DB::table('nhacungcap')->where('NhaCungCapID', $id)->first();
        return view('admin.supplier.edit', [
            'title' => 'Chỉnh sửa nhà cung cấp: ' . $supplier->TenNhaCungCap,
            'supplier' => $supplier,
        ]);
    }

    public function update(Request $request, $id)
    {
        $supplier = DB::table('nhacungcap')->where('NhaCungCapID', $id)->first();
        $request->validate([
            'name' => 'required',
            'sdt' => 'required|numeric|digits_between:10,11|unique:nhacungcap,SoDienThoai,' . $id . ',NhaCungCapID',
            'email' => 'required|email|unique:nhacungcap,Email,' . $id . ',NhaCungCapID',
            'nganhhang' => 'required',
        ]);
        $suppliers = array();
        $suppliers['TenNhaCungCap'] = $request->name;
        $suppliers['SoDienThoai'] = $request->sdt;
        $suppliers['Email'] = $request->email;
        $suppliers['NganhHang'] = $request->nganhhang;
        try {
            DB::table('nhacungcap')->where('NhaCungCapID', $id)->update($suppliers);
            Session::flash('success', 'Chỉnh sửa thành công Danh mục');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
        }
        return redirect()->route('admin.supplier.list');
    }

    public function destroy(Request $request)
    {
        $id = (int) $request->input('id');
        $supplier = DB::table('nhacungcap')->where('NhaCungCapID', $id)->first();
        if ($supplier) {
            try {
                DB::table('nhacungcap')->where('NhaCungCapID', $id)->delete();
                return response()->json(['error' => false, 'message' => 'Xóa thành công nhà cung cấp']);
            } catch (\Exception $err) {
                return response()->json([
                    'error' => true,
                    'message' => 'Nhà cung cấp có trong phiếu nhập nên không thể xóa',
                ]);
            }
        }
        return response()->json([
            'error' => true,
            'message' => 'Xóa không thành công',
        ]);
    }
}
