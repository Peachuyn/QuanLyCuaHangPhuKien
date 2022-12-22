<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $customer = DB::table('khachhang')->get();
        return view('admin.customer.list', [
            'title' => 'Danh sách khách hàng',
            'customer' => $customer,
        ]);
    }

    public function show($id)
    {
        $customer = DB::table('khachhang')->where('id', $id)->first();
        return view('admin.customer.edit', [
            'title' => 'Chỉnh sửa thông tin Khách hàng: ' . $customer->TenKhachHang,
            'customer' => $customer,
        ]);
    }

    public function update(Request $request, $id)
    {
        $customer = DB::table('khachhang')->where('id', $id)->first();
        $request->validate([
            'name' => 'required',
            'sdt' => 'required|numeric|digits_between:10,11|unique:khachhang,SoDienThoai,' . $id . ',id',
            'email' => 'required|email|unique:khachhang,email,' . $id . ',id',
            'addr' => 'required',
        ]);
        $customers = array();
        $customers['TenKhachHang'] = $request->name;
        $customers['SoDienThoai'] = $request->sdt;
        $customers['GioiTinh'] = $request->sex;
        $customers['email'] = $request->email;
        $customers['DiaChi'] = $request->addr;
        try {
            DB::table('khachhang')->where('id', $id)->update($customers);
            Session::flash('success', 'Chỉnh sửa thành công Danh mục');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
        }
        return redirect()->route('admin.customer.list');
    }
}
