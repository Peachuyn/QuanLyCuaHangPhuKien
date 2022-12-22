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
                <button type="submit" class="btn btn-default" onclick="search('/admin/customer/search')">
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
                <th>ID</th>
                <th>Tên Khách Hàng</th>
                <th>Số điện thoại</th>
                <th>Giới tính</th>
                <th>Email</th>
                <th>Địa Chỉ</th>
                <th style="width: 100px;">&nbsp;</th>

              </tr>
            </thead>
            <tbody>
                @foreach($customer as $customer)
              <tr>
                <td>{{$customer->id}}</td>
                <td>{{$customer->TenKhachHang}}</td>
                <td>{{$customer->SoDienThoai}}</td>
                <td>{{$customer->GioiTinh==0?'Nữ':'Nam'}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->DiaChi}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/customer/edit/{{$customer->id}}">
                        <i class="fas fa-edit"></i>
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

