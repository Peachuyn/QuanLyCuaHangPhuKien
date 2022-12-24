@extends('admin.main')

@section('content')
<form action="" method="post">
    <div class="card-body">
      <div class="form-group">
        <label for="menu">Tên khách hàng</label>
        <input disabled type="text" name="sdt" class="form-control" id="menu" placeholder="Nhập số điện thoại" value="{{$donhang->TenKhachHang}}">
      </div>
      <div class="form-group">
        <label for="menu">Tên nhân viên</label>
        <input disabled type="text" name="email" class="form-control" id="menu" placeholder="Nhập Email" value="{{$donhang->name}}">
      </div>
      <div class="form-group">
        <label for="menu">Giá ship</label>
        <input disabled type="text" name="nganhhang" class="form-control" id="menu" placeholder="Nhập Tên ngành hàng" value="{{$donhang->GiaShip}}">
      </div>
      <div class="form-group">
        <label for="menu">Tổng Tiền</label>
        <input disabled type="text" name="nganhhang" class="form-control" id="menu" placeholder="Nhập Tên ngành hàng" value="{{$donhang->TongTien}}">
      </div>
      <div class="form-group">
        <label for="menu">Địa chỉ</label>
        <input disabled type="text" name="nganhhang" class="form-control" id="menu" placeholder="Nhập Tên ngành hàng" value="{{$donhang->DiaChi.', '.$donhang->TenQuan.', '.$donhang->TenTinh}}">
      </div>
      <div class="form-group">
        <label>Trạng thái đơn hàng</label>
        <select {{$donhang->DonHang_TinhTrang==3?'disabled':''}} class="form-control wide w-100" id="gender" name="trangthai">
            <option value="0" {{$donhang->DonHang_TinhTrang==0?'selected':''}}>Đơn hàng mới</option>
            <option value="1" {{$donhang->DonHang_TinhTrang==1?'selected':''}}>Đơn hàng đang được giao</option>
            <option value="2" {{$donhang->DonHang_TinhTrang==2?'selected':''}}>Đơn hàng đã hoàn thành</option>
            <option value="3" {{$donhang->DonHang_TinhTrang==3?'selected':''}}>Đơn hàng đã hủy</option>
        </select>
    </div> 
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Cập nhật tình trạng đơn hàng</button>
    </div>
  @csrf

  </form>
@endsection
