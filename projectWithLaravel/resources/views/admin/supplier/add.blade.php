@extends('admin.main')

@section('content')
<form action="" method="post">
    <div class="card-body">
      <div class="form-group">
        <label for="menu">Tên Nhà cung cấp</label>
        <input type="text" name="name" class="form-control" id="menu" placeholder="Nhập tên nhà cung cấp">
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
        <label for="menu">Tên ngành hàng</label>
        <input type="text" name="nganhhang" class="form-control" id="menu" placeholder="Nhập Tên ngành hàng">
      </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Tạo nhà cung cấp</button>
    </div>
  @csrf

  </form>
@endsection
