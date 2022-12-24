<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function listcost()
    {
        $donhangs = DB::table('donhang')
            ->select(DB::raw('sum(TongTien) as `TongTien`'), DB::raw('MONTH(ThoiGianTao) month, YEAR(ThoiGianTao) year'))
            ->groupby('year', 'month')
            ->get();

        return view('admin.statistic.cost', [
            'title' => 'Thống kê doanh thu',
            'donhangs' => $donhangs,
        ]);
    }
    public function listrevenue()
    {
        $phieunhaps = DB::table('phieunhap')
            ->join('chitietphieunhap', 'phieunhap.SoPN', '=', 'chitietphieunhap.SoPN')
            ->select(DB::raw('sum(GiaNhap*SoLuong) as `TongTien`'), DB::raw('MONTH(NgayNhap) month, YEAR(NgayNhap) year'))
            ->groupby('year', 'month')
            ->get();

        return view('admin.statistic.revenue', [
            'title' => 'Thống kê chi phí',
            'phieunhaps' => $phieunhaps,
        ]);
    }
    public function thongke(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $donhangs = DB::table('donhang')->select(DB::raw('sum(TongTien) as `TongTien`'), DB::raw('MONTH(ThoiGianTao) month, YEAR(ThoiGianTao) year'))
            ->whereYear('ThoiGianTao', '=', $year)
            ->whereMonth('ThoiGianTao', '=', $month)
            ->groupby('year', 'month')
            ->get();
        $result = '';
        foreach ($donhangs as $donhang) {
            $result .= "<tr>
            <td>$donhang->month</td>
            <td>$donhang->year</td>
            <td>$donhang->TongTien</td>
        </tr>";
        }
        return response()->json($result);
    }

    public function thongkecp(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $phieunhaps = DB::table('phieunhap')->join('chitietphieunhap', 'phieunhap.SoPN', '=', 'chitietphieunhap.SoPN')
            ->select(DB::raw('sum(GiaNhap) as `TongTien`'), DB::raw('MONTH(NgayNhap) month, YEAR(NgayNhap) year'))
            ->whereYear('NgayNhap', '=', $year)
            ->whereMonth('NgayNhap', '=', $month)
            ->groupby('year', 'month')
            ->get();
        $result = '';
        foreach ($phieunhaps as $phieunhap) {
            $result .= "<tr>
            <td>$phieunhap->month</td>
            <td>$phieunhap->year</td>
            <td>$phieunhap->TongTien</td>
        </tr>";
        }
        return response()->json($result);
    }
}
