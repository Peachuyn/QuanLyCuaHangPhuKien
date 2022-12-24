@extends('admin.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="display: flex;">
                <label for="start" style="margin: auto 0px">Chọn Thời Gian:</label>

                <input class="thangnamcp" type="month" value="2022-11" id="start" name="start" style="margin: auto 0px">
                <div class="card-header">
                    <button type="submit" class="btn btn-primary" onclick="thongkecp('/admin/statistics/thongkecp')">
                        Thống Kê
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 70vh;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>Tháng</th>
                            <th>Năm</th>
                            <th>Tổng Tiền</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($phieunhaps as $phieunhap)
                        <tr>
                            <td>{{$phieunhap->month}}</td>
                            <td>{{$phieunhap->year}}</td>
                            <td>{{$phieunhap->TongTien}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection