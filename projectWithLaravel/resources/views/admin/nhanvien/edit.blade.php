@extends('admin.main')

@section('content')
<form action="" method="post">
    <div class="card-body">
      <div class="form-group">
        <label for="menu">Tên nhân viên</label>
        <input type="text" name="name" class="form-control" id="menu" placeholder="Nhập tên nhân viên" value="{{$nhanvien->name}}">
      </div>
      <div class="form-group">
        <label for="menu">Chức vụ</label>
        <input type="text" name="chucvu" class="form-control" id="menu" placeholder="Nhập chức vụ" value="{{$nhanvien->role==1? 'Quản lý' : 'Nhân viên'}}">
      </div>
      <div class="form-group">
        <label for="menu">Số điện thoại</label>
        <input type="text" name="sdt" class="form-control" id="menu" placeholder="Nhập số điện thoại" value="{{$nhanvien->phoneNumber}}">
      </div>
      <div class="form-group">
        <label for="menu">Email</label>
        <input type="text" name="email" class="form-control" id="menu" placeholder="Nhập Email" value="{{$nhanvien->email}}">
      </div>
      <div class="form-group">
        <label for="menu">Địa chỉ</label>
        <input type="text" name="diachi" class="form-control" id="menu" placeholder="Nhập địa chỉ" value="{{$nhanvien->address}}">
      </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
  @csrf

  </form>
@endsection
