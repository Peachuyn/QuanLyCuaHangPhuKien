<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class ClientController extends Controller
{
    public function getLogin()
    {
        return view('client.login.login');
    }

    public function postLogin(Request $request)
    {
        // dd($request->input());

        $this->validate($request, [
            'email' => 'required|exists:khachhang,email',
            'password' => 'required',
        ], [
            'email.required' => 'Bạn chưa nhập Email',
            'password.required' => 'Bạn chưa nhập Password',
        ]);
        if (Auth::guard('khachhang')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ])) {
            return redirect()->route('client.home');
        } else {
            return redirect()->back()->with('error', 'Đăng nhập không thành công');
        }
    }

    public function getRegister()
    {
        return view('client.login.register');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|string|regex:/^\S*$/u|max:255|unique:khachhang,username',
            'email' => 'required|email|unique:khachhang,email',
            'password' => 'required|min:3|max:30',
            'cpassword' => 'required|min:3|max:30|same:password',
        ]);

        $khachhang = new Customer();
        $khachhang->TenKhachHang = $request->name;
        $khachhang->UserName = $request->username;
        $khachhang->email = $request->email;
        $khachhang->password = bcrypt($request->password);
        $save = $khachhang->save();

        if ($save) {
            return redirect()->back()->with('success', 'You are now registered successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong, failed to register');
        }
    }

    public function logout()
    {
        Auth::guard('khachhang')->logout();
        return redirect()->route('client.login');
    }

    public function view()
    {
        $khachhang = Auth::guard('khachhang')->user();
        return view('client.my-account.my-info')->with('khachhang', $khachhang);
    }

    public function edit(Request $request)
    {

        // dd($request->gender);
        $khachhang = Auth::guard('khachhang')->user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:khachhang,email,' . $khachhang->id,
            'phonenumber' => 'required|numeric|unique:khachhang,SoDienThoai,' . $khachhang->id,
        ]);
        $khachhang->TenKhachHang = $request->name;
        $khachhang->GioiTinh = $request->gender;
        $khachhang->email = $request->email;
        $khachhang->SoDienThoai = $request->phonenumber;
        $khachhang->DiaChi = $request->address;
        $khachhang->save();
        return redirect()->route('client.my-info')->with('success', 'Bạn đã cập nhật thông tin khách hàng thành công');
    }
}
