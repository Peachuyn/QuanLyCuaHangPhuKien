@extends('admin.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
<form action="" method="post">
    <div class="card-body">
      <div class="form-group">
        <label for="menu">Tên Sản phẩm</label>
        <input type="text" name="name" class="form-control" id="menu" placeholder="Nhập tên sản phẩm">
      </div>
      <div class="form-group">
        <label for="chatlieu" >Chất liệu</label>
        <select class="form-control" name ="chatlieu" >
            @foreach($chatlieus as $chatlieu)
                <option value ="{{$chatlieu->ChatLieuID}}">{{$chatlieu->ChatLieu_Ten}}</option>
            @endforeach
          </select>
      </div>
      <div class="form-group">
        <label for="giacong" >Danh mục</label>
        <select class="form-control" name ="danhmuc">
          @foreach($menus as $menu)
                <option value ="{{$menu->id}}">{{$menu->name}}</option>
         @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="content">Mô tả</label>
        <textarea name="mota" id="content" class="form-control" cols="20" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label>Giá</label>
        <input type="number" name="gia" class="form-control" step="1000" min="0" placeholder="Nhập giá sản phẩm">
      </div>
      <div class="form-group">
        <label>Số lượng</label>
        <input type="number" name="soluong" class="form-control" step="1" min="0" placeholder="Nhập số lượng sản phẩm">
      </div>
      <div class="form-group">
        <label for="menu">Hình ảnh</label>
        <input type="file" name="hinhanh" class="form-control">
      </div>
      <div class="form-group">
        <label for="giacong" >Gia công</label>
        <select class="form-control" name ="giacong">
                <option value ="0">Có sẵn</option>
                <option value ="1">Thiết kế theo yêu cầu</option>
        </select>
      </div>
      <div class="form-group">
        <label>Cân nặng (gram)</label>
        <input type="number" name="cannang" class="form-control" step="50" min="50" placeholder="Nhập cân nặng sản phẩm">
      </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Thêm mới sản phẩm</button>
    </div>
  @csrf

  </form>
@endsection

@section('footer')
  <script>CKEDITOR.replace('content')</script>
@endsection
