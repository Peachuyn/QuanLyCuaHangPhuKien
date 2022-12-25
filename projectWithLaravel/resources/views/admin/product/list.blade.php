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
                <button type="submit" class="btn btn-default btn-search" onclick="search('/admin/products/search')">
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
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Chất liệu</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Số lượng bán</th>
                <th>Gia công</th>
                <th>Cân nặng</th>
                <th style="width: 100px;">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
              <tr>
                <td>{{$product->SanPhamID}}</td>
                <td><img style="
                    width: 50px;
                " src="{{'/template/admin/images/SanPhamBellezza/SanPham/'.$product->HinhAnh}}" alt=""></td>
                <td>{{$product->SanPhamTen}}</td>
                <td>{{$product->ChatLieu_Ten}}</td>
                <td>{{$product->Gia}}</td>
                <td>{{$product->SoLuong}}</td>
                <td>{{$product->SoLuong_Ban}}</td>
                <td>@if($product->GiaCong==0)Có sẵn @else Thiết kế theo yêu cầu @endif</td>
                <td>{{$product->CanNang}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{$product->SanPhamID}}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="removeRow('{{$product->SanPhamID}}', '/admin/products/destroy')">
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
