@extends('admin.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
<form action="" method="post">
    <div class="card-body">
      <div class="form-group">
        <label for="menu">Tên Sản phẩm</label>
        <input type="text" name="name" class="form-control" id="menu" placeholder="Nhập tên sản phẩm" value="{{$product->SanPhamTen}}">
      </div>
      <div class="form-group">
        <label for="chatlieu" >Chất liệu</label>
        <select class="form-control" name ="chatlieu" >
            @foreach($chatlieus as $chatlieu)
                <option {{$chatlieu->ChatLieuID==$product->ChatLieuID?"selected":""}} value ="{{$chatlieu->ChatLieuID}}">{{$chatlieu->ChatLieu_Ten}}</option>
            @endforeach
          </select>
      </div>
      <div class="form-group">
        <label for="giacong" >Danh mục</label>
        <select class="form-control" name ="danhmuc">
          @foreach($menus as $menu)
                <option {{$menu->id==$product->PhanLoaiID?"selected":""}} value ="{{$menu->id}}">{{$menu->name}}</option>
         @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="content">Mô tả</label>
        <textarea name="mota" id="content" class="form-control" cols="20" rows="3">{{$product->MoTa}}</textarea>
      </div>
      <div class="form-group">
        <label>Giá</label>
        <input type="number" name="gia" class="form-control" step="1000" min="0" placeholder="Nhập giá sản phẩm" value="{{$product->Gia}}">
      </div>
      <div class="form-group">
        <label>Số lượng</label>
        <input type="number" name="soluong" class="form-control" step="1" min="0" placeholder="Nhập số lượng sản phẩm" value="{{$product->SoLuong}}">
      </div>
      <div class="form-group">
        <label for="menu">Hình ảnh</label>
        <img style="width: 50px;" src="{{'/template/admin/images/SanPhamBellezza/SanPham/'.$product->HinhAnh}}" alt="">
        <input type="file" name="hinhanh" class="form-control">
      </div>
      <div class="form-group">
        <label for="giacong" >Gia công</label>
        <select class="form-control" name ="giacong">
                <option {{$product->GiaCong==0?"selected":""}} value ="0">Có sẵn</option>
                <option {{$product->GiaCong==1?"selected":""}} value ="1">Thiết kế theo yêu cầu</option>
        </select>
      </div>
      <div class="form-group">
        <label>Cân nặng (gram)</label>
        <input type="number" name="cannang" class="form-control" step="50" min="50" placeholder="Nhập cân nặng sản phẩm" value="{{$product->CanNang}}">
      </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Chỉnh sửa sản phẩm</button>
    </div>
  @csrf

  </form>
@endsection

@section('footer')
  <script>CKEDITOR.replace('content')</script>
@endsection
