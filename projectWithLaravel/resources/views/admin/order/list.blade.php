@extends('admin.main')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 50vh;">
              <input type="text" name="table_search" class="form-control float-right search" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default btn-search" onclick="search('/admin/orders/search')">
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
                <td class="project_progress">
                    @if($order->DonHang_TinhTrang==0)
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                    </div>
                  </div>
                  <small>
                    30% Complete
                </small>
                    @elseif($order->DonHang_TinhTrang==1)
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    </div>
                  </div>
                  <small>
                    60% Complete
                </small>
                    @elseif($order->DonHang_TinhTrang==2)
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    </div>
                  </div> 
                  <small>
                    100% Complete
                </small>
                    @elseif($order->DonHang_TinhTrang==3)
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-red" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    </div>
                  </div>
                  <small>
                    Cancel
                </small>
                    @endif
                  
                </td>
                <td>@if($order->DonHang_TinhTrang==0)Đơn hàng mới
                    @elseif($order->DonHang_TinhTrang==1)Đơn hàng đang được giao
                    @elseif($order->DonHang_TinhTrang==2)Đơn hàng đã hoàn thành
                    @elseif($order->DonHang_TinhTrang==3)Đơn hàng đã hủy
                    @endif
                </td>
                <td>{{$order->GiaShip}}</td>
                <td>{{$order->TongTien}}</td>
                <td>{{$order->DiaChi.', '.$order->TenQuan.', '.$order->TenTinh}}</td>
                <td>{{$order->ThoiGianTao}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/orders/edit/{{$order->DonHangID}}">
                        <i class="fas fa-edit"></i>
                    </a>
                    {{-- DANG LAM PDF --}}

                    <a target="_blank" href="{{url('/admin/orders/print/'.$order->DonHangID) }}">In đơn hàng</a>
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
