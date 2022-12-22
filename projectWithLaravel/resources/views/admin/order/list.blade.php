@extends('admin.main')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 50vh;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 70vh;">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>#ID</th>
                <th>Tên khách hàng</th>
                <th>Nhân viên</th>
                <th>Đơn hàng tiến trình</th>
                <th>Tình trạng</th>
                <th>Giá ship</th>
                <th>Tổng Tiền</th>
                <th>Địa chỉ</th>
                <th>Update</th>
                <th style="width: 100px;">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
              <tr>
                <td>{{$order->DonHangID}}</td>
                <td>{{$order->TenKhachHang}}</td>
                <td>{{$order->name}}</td>
                <td class="project_progress">
                  <div class="progress progress-sm">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                      </div>
                  </div>
                  <small>
                      57% Complete
                  </small>
                </td>
                <td>{{$order->DonHang_TinhTrang}}</td>
                <td>{{$order->GiaShip}}</td>
                <td>{{$order->TongTien}}</td>
                <td>{{$order->DiaChi}}</td>
                <td>{{$order->ThoiGianTao}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/suppliers/edit/{{$order->DonHangID}}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="removeRow('{{$order->DonHangID}}', '/admin/suppliers/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
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
