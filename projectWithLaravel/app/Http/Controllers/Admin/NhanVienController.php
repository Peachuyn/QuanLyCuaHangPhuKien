<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NhanVienController extends Controller
{
    //
    public function create (){
        return view('admin.nhanvien.add', [
            'title' => 'Thêm nhân viên']);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sdt' => 'required|numeric|digits_between:10,11|unique:users,phoneNumber',
            'email' => 'required|email|unique:users,email',
            'diachi' => 'required',
        ]);
        $nhanvien = array();
        // $suppliers['TenNhaCungCap'] = $request->name;
        // $suppliers['SoDienThoai'] = $request->sdt;
        // $suppliers['Email'] = $request->email;
        // $suppliers['NganhHang'] = $request->nganhhang;
        $nhanvien['name'] = $request->name;
        $nhanvien['role'] = $request->chucvu;
        $nhanvien['password'] = $request->password;
        $nhanvien['phoneNumber'] = $request->sdt;
        $nhanvien['email'] = $request->email;
        $nhanvien['address'] = $request->diachi;
        try {
            DB::table('users')->insert($nhanvien);
            Session::flash('success', 'Thêm thành công Nhân viên');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
        }
        return redirect()->back();
    }
    public function index()
    {
        $nhanvien = DB::table('users')->get();
        return view('admin.nhanvien.list', [
            'title' => 'Danh sách nhân viên',
            'nhanvien' => $nhanvien,
        ]);
    }
    public function show($id)
    {
        $nhanvien = DB::table('users')->where('id', $id)->first();
        return view('admin.nhanvien.edit', [
            'title' => 'Chỉnh sửa thông tin nhân viên: ' . $nhanvien->name,
            'nhanvien' => $nhanvien,
        ]);
    }
    public function update(Request $request, $id)
    {
        $supplier = DB::table('users')->where('id', $id)->first();
        $request->validate([
            'name' => 'required',
            'chucvu' => 'required',
            'sdt' => 'required|numeric|digits_between:10,11|unique:users,phoneNumber,' . $id . ',id',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
            'diachi' => 'required',
        ]);
        $nhanvien = array();
        $nhanvien['name'] = $request->name;
        $nhanvien['role'] = $request->role;
        $nhanvien['phoneNumber'] = $request->phoneNumber;
        $nhanvien['email'] = $request->email;
        $nhanvien['address'] = $request->address;
        try {
            DB::table('users')->where('id', $id)->update($nhanvien);
            Session::flash('success', 'Chỉnh sửa thành công Thông tin nhân viên');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
        }
        return redirect()->route('admin.supplier.list');
    }
    public function destroy(Request $request)
    {
        $id = (int) $request->input('id');
        $nhanvien = DB::table('users')->where('id', $id)->first();
        if ($nhanvien) {
            try {
                DB::table('users')->where('id', $id)->delete();
                return response()->json(['error' => false, 'message' => 'Xóa thành công nhân viên']);
            } catch (\Exception $err) {
                return response()->json([
                    'error' => true,
                    'message' => 'Không thể xóa nhân viên',
                ]);
            }
        }
        return response()->json([
            'error' => true,
            'message' => 'Xóa không thành công',
        ]);
    }
}
