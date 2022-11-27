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
                        <form id="contactForm" novalidate="true">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-2 mt-4">
                                        <label for="name">Tên đăng nhập: </label>
                                        <h4 class="d-inline">daouyen</h4>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="name">Tên: </label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required="" data-error="Please enter your name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="name">Password: </label>
                                        <input type="text" placeholder="Your Password" id="email" class="form-control" name="name" required="" data-error="Please enter your password">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                            <label for="gender  ">Giới tính</label>
                                            <select class="wide w-100" id="country">
                                                <option value="Choose..." data-display="Select">Choose...</option>
                                                <option value="nam">Nam</option>
                                                <option value="nu">Nữ</option>
                                            </select>
                                            <div class="invalid-feedback"> Please select a valid country. </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="name">Email: </label>
                                        <input type="text" placeholder="Your Email" id="email" class="form-control" name="name" required="" data-error="Please enter your email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="name">Số điện thoại: </label>
                                        <input type="text" placeholder="Your Phone" id="email" class="form-control" name="name" required="" data-error="Please enter your phone number">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="country">Tỉnh/Thành phố</label>
                                        <select class="wide w-100" id="province">
                                            <option value="Choose..." data-display="Select">Choose...</option>
                                            <option value="VungTau">Vũng Tàu</option>
                                        </select>
                                        <div class="invalid-feedback"> Please select a valid province. </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                            <label for="state">Quận/Huyện</label>
                                            <select class="wide w-100" id="district">
                                                <option data-display="Select">Choose...</option>
                                                <option>Châu Đức</option>
                                            </select>
                                        <div class="invalid-feedback"> Please provide a valid district. </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="name">Địa chỉ nhận hàng: </label>
                                            <input type="text" placeholder="Your address" id="email" class="form-control" name="name" required="" data-error="Please enter your phone number">
                                            <div class="help-block with-errors"></div>
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