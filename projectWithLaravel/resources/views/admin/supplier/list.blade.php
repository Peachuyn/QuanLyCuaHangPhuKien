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
                <button type="submit" class="btn btn-default btn-search" onclick="search('/admin/suppliers/search')">
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
                <th>Tên nhà cung cấp</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Ngành hàng</th>
                <th>Update</th>
                <th style="width: 100px;">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $supplier)
              <tr>
                <td>{{$supplier->NhaCungCapID}}</td>
                <td>{{$supplier->TenNhaCungCap}}</td>
                <td>{{$supplier->SoDienThoai}}</td>
                <td>{{$supplier->Email}}</td>
                <td>{{$supplier->NganhHang}}</td>
                <td>{{$supplier->ThoiGianTao}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/suppliers/edit/{{$supplier->NhaCungCapID}}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="removeRow('{{$supplier->NhaCungCapID}}', '/admin/suppliers/destroy')">
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
