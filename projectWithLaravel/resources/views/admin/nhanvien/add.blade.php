@extends('admin.main')

@section('content')
<form action="" method="post">
    <div class="card-body">
      <div class="form-group">
        <label for="menu">Tên Nhân viên</label>
        <input type="text" name="name" class="form-control" id="menu" placeholder="Nhập tên nhân viên">
      </div>
      <div>
        <label for="menu" >Chức vụ</label>
        <select class="form-control" name ="chucvu" >
                            <option value ="1">Quản lý</option>
                            <option value ="0" >Nhân viên</option>
          </select>
      </div>
      <div class="form-group">
        <label for="menu">Giới tính</label>
        <select class="custom-select rounded-0" id="exampleSelectRounded0" name = "gioitinh">
          <option value = "1">Nữ</option>
          <option value = "0">Nam</option>
        </select>
      </div>
      <div class="form-group">
        <label for="menu">Mật khẩu</label>
        <input type="password" name="password" class="form-control" id="menu" placeholder="Nhập mật khẩu">
      </div>
      <div class="form-group">
        <label for="menu">Số điện thoại</label>
        <input type="text" name="sdt" class="form-control" id="menu" placeholder="Nhập số điện thoại">
      </div>
      <div class="form-group">
        <label for="menu">Email</label>
        <input type="text" name="email" class="form-control" id="menu" placeholder="Nhập Email">
      </div>
      <div class="form-group">
        <label for="menu">Địa chỉ</label>
        <input type="text" name="diachi" class="form-control" id="menu" placeholder="Nhập địa chỉ">
      </div>
  

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Thêm mới nhân viên</button>
    </div>
  @csrf

  </form>
@endsection
