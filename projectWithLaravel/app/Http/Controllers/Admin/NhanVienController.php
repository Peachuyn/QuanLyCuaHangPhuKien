<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NhanVienController extends Controller
{
    //
    public function create (){
        return view('admin.nhanvien.add');
    }
    public function index (){
        return view('admin.nhanvien.list');
    }
}
