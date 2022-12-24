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
                <button type="submit" class="btn btn-default" onclick="search('/admin/nhanvien/search')">
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
                <th>Tên nhân viên</th>
                <th>Chức vụ</th>
                <th>Giới tính</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                {{-- <th>Ngành hàng</th>
                <th>Update</th> --}}
                <th style="width: 100px;">&nbsp;</th>

              </tr>
            </thead>
            <tbody>
                @foreach($nhanvien as $nhanvien)
              <tr>
                <td>{{$nhanvien->id}}</td>
                <td>{{$nhanvien->name}}</td>
                <td>{{$nhanvien->role==1? 'Quản lý' : 'Nhân viên'}}</td>
                <td>{{$nhanvien->gender==1?'Nữ':'Nam'}}</td>
                <td>{{$nhanvien->phoneNumber}}</td>
                <td>{{$nhanvien->email}}</td>
                <td>{{$nhanvien->address}}</td>
                {{-- <td>{{$supplier->NganhHang}}</td>
                <td>{{$supplier->ThoiGianTao}}</td> --}}
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/nhanvien/edit/{{$nhanvien->id}}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="removeRow('{{$nhanvien->id}}', '/admin/nhanvien/destroy')">
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
