<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function list()
    {
        $suppliers = DB::table('nhacungcap')->get();
        return view('admin.order.list', [
            'title' => 'Danh sách đơn hàng mới nhất',
            'suppliers' => $suppliers,
        ]);
    }
}
