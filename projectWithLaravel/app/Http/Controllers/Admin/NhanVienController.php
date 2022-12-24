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
    public function create()
    {
        return view('admin.nhanvien.add', [
            'title' => 'Thêm nhân viên'
        ]);
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
        $nhanvien['name'] = $request->name;
        $nhanvien['gender'] = $request->gioitinh;
        $nhanvien['role'] = $request->chucvu;
        $nhanvien['password'] = bcrypt($request->password);
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
        $nhanvien = DB::table('users')->where('id', $id)->first();
        $request->validate([
            'name' => 'required',
            'chucvu' => 'required',
            'sdt' => 'required|numeric|digits_between:10,11|unique:users,phoneNumber,' . $id . ',id',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
            'diachi' => 'required',
        ]);
        $nhanvien = array();
        $nhanvien['name'] = $request->name;
        $nhanvien['role'] = $request->chucvu;
        $nhanvien['phoneNumber'] = $request->sdt;
        $nhanvien['email'] = $request->email;
        $nhanvien['address'] = $request->diachi;
        try {
            DB::table('users')->where('id', $id)->update($nhanvien);
            Session::flash('success', 'Chỉnh sửa thành công Thông tin nhân viên');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
        }
        return redirect()->route('admin.nhanvien.list');
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
    public function search(Request $request)
    {
        $data = $request->input('data');
        $nhanviens = DB::table('users')
            ->where('name', 'like', '%' . $data . '%')
            ->orWhere('phoneNumber', 'like', '%' . $data . '%')
            ->get();
        $result = "";
        foreach ($nhanviens as $nhanvien) {
            $sex = $nhanvien->gender == 1 ? 'Nữ' : 'Nam';
            $chucvu = $nhanvien->role == 1 ? 'Quản lý' : 'Nhân viên';

            $result .=
                "<tr>
                <td>$nhanvien->id</td>
                <td>$nhanvien->name</td>
                <td>$chucvu</td>
                <td>$sex</td>
                <td>$nhanvien->phoneNumber</td>
                <td>$nhanvien->email</td>
                <td>$nhanvien->address</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='/admin/nhanvien/edit/$nhanvien->id'>
                        <i class='fas fa-edit'></i>
                    </a>
                    <a href='#' class='btn btn-danger btn-sm' onclick=\"removeRow('$nhanvien->id', '/admin/nhanvien/destroy')\">
                        <i class='fas fa-trash'></i>
                    </a>
                </td>
              </tr>";
        };
        return response()->json($result);
    }
}
