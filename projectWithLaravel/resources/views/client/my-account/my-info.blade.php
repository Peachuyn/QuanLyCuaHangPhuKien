@extends('client.layout')

@section('content')
    <!-- Start My info  -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-form-right">
                        <h2>Hồ sơ của tôi</h2>
                        <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
    @include('admin/alert')

                        <form action="my-info" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-2 mt-4">
                                        <label for="username">Tên đăng nhập: </label>
                                        <h4 class="d-inline">{{$khachhang->UserName}}</h4>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="name">Tên: </label>
                                        <input value="{{$khachhang->TenKhachHang}}" type="text" class="form-control" id="name" name="name" placeholder="Your Name" required="" data-error="Please enter your name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                            <label for="gender">Giới tính</label>
                                            <select class="wide w-100" id="gender" name="gender">
                                                {{-- <option value="Choose..." data-display="Select">Choose...</option> --}}
                                                <option value="1" {{$khachhang->GioiTinh==1?'selected':''}}>Nam</option>
                                                <option value="0" {{$khachhang->GioiTinh==0?'selected':''}}>Nữ</option>
                                            </select>
                                            <div class="invalid-feedback"> Please select a valid country. </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="email">Email: </label>
                                        <input value="{{$khachhang->email}}" type="text" placeholder="Your Email" id="email" class="form-control" name="email" required="" data-error="Please enter your email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="phonenumber">Số điện thoại: </label>
                                        <input value="{{$khachhang->SoDienThoai}}" type="text" placeholder="Your Phone" id="phonenumber" class="form-control" name="phonenumber" required="" data-error="Please enter your phone number">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="address">Địa chỉ nhận hàng: </label>
                                            <input value="{{$khachhang->DiaChi}}" type="text" placeholder="Your address" id="address" class="form-control" name="address" required="" data-error="Please enter your phone number">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="submit-button text-center">
                                            <button class="btn hvr-hover disabled" id="submit" type="submit" style="pointer-events: all; cursor: pointer;">EDIT</button>
                                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
				<div class="col-lg-4 col-sm-12">
                    <div class="contact-info-left">
                        <h2>CONTACT INFO</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent urna diam, maximus ut ullamcorper quis, placerat id eros. Duis semper justo sed condimentum rutrum. Nunc tristique purus turpis. Maecenas vulputate. </p>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>Address: Michael I. Days 9000 <br>Preston Street Wichita,<br> KS 87213 </p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+1-888 705 770</a></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">contactinfo@gmail.com</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End My info  -->
@endsection


@section('title')
<h2>My info</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">My account</a></li>
                    <li class="breadcrumb-item active">My info</li>
                </ul>
@endsection