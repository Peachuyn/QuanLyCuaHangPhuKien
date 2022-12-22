@extends('admin.main')

@section('content')
<form action="" method="post">
    <div class="card-body">
      <div class="form-group">
        <label for="menu">Tên Khách Hàng</label>
        <input type="text" name="name" class="form-control" id="menu" placeholder="Nhập tên Khách hàng" value="{{$customer->TenKhachHang}}">
      </div>
      <div class="form-group">
        <label for="menu">Số điện thoại</label>
        <input type="text" name="sdt" class="form-control" id="menu" placeholder="Nhập số điện thoại" value="{{$customer->SoDienThoai}}">
      </div>
      <div>
      <label for="menu" >Giới Tính</label>
      <select class="form-control" name ="sex" >
                          <option value ="1">Nam</option>
                          <option value ="0" >Nữ</option>
        </select>
      </div>
      <div class="form-group">
        <label for="menu">Email</label>
        <input type="text" name="email" class="form-control" id="menu" placeholder="Nhập Email" value="{{$customer->email}}">
      </div>
      <div class="form-group">
        <label for="menu">Địa chỉ</label>
        <input type="text" name="addr" class="form-control" id="menu" placeholder="Nhập Địa chỉ" value="{{$customer->DiaChi}}">
      </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
    </div>
  @csrf

  </form>
@endsection
