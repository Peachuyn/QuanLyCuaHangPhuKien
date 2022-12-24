    <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="custom-select-box">
                        <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
							<option>VND</option>
						</select>
                    </div>
                    <div class="right-phone-box">
                        <p>Call US :- <a href="#"> 058 955 9343</a></p>
                    </div>
                    <div class="our-link">
                        <ul>
                            <li><a href="#"><i class="fa fa-user s_color"></i> My Account</a></li>
                            <li><a href="#"><i class="fas fa-location-arrow"></i> Our location</a></li>
                            <li><a href="#"><i class="fas fa-headset"></i> Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="login-box" style="background:#af9ad5; text-align:center;">
                        <a class="text-white" href="{{route('client.logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        <form action="{{route('client.logout')}}" id="logout-form" method="post">@csrf</form>
					</div>

                    <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker">
                            <ul class="offer-box">
                                <li>
                                    <i class="fab fa-opencart"></i> Giá thành hợp lý
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Sản phẩm chất lượng
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Mặt hàng đa dạng
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Mẫu mã dễ thương
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Hỗ trợ nhanh chóng
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Nhiều màu sắc lựa chọn
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="/shop/home"><img src="/template/client/images/logo.png" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item"><a class="nav-link" href="{{route('client.home')}}">Home</a></li>
                        <li class="nav-item active"><a class="nav-link" href="{{route('client.about-us')}}">About Us</a></li>
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">SHOP</a>
                            <ul class="dropdown-menu">
								<li><a href="{{route('client.all-product')}}">Sidebar Shop</a></li>
                                <li><a href="{{route('client.cart')}}">Cart</a></li>
                                <li><a href="{{route('client.checkout')}}">Checkout</a></li>
                                <li><a href="{{route('client.my-account')}}">My Account</a></li>
                                <li><a href="{{route('client.wishlist')}}">Wishlist</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{route('client.gallery')}}">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('client.contact-us')}}">Contact Us</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        {{-- <li class="search"><a href="#"><i class="fa fa-search"></i></a></li> --}}
                        <li class="side-menu"><a href="#">
						<i class="fa fa-shopping-bag"></i>
                        @if(isset($GioHang_float))
                            <span id="cart_count" class="badge">{{$GioHang_float->SoLuong}}</span>
                        @else
                            <span id="cart_count" class="badge">0</span>
                        @endif
							<p>My Cart</p>
					</a></li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <ul class="cart-list">
                        @if(isset($GioHangCT_floats))
                        @foreach ($GioHangCT_floats as $GioHangCT_float)
                        <li class="product-list product-{{$GioHangCT_float->SanPhamID}}" id="{{$GioHangCT_float->GioHangChiTietID}}">
                            <a href="#" class="photo"><img src="{{'/template/admin/images/SanPhamBellezza/SanPham/'.$GioHangCT_float->HinhAnh}}" class="cart-thumb" alt="" /></a>
                            <h6><a href="/shop/product-detail/{{$GioHangCT_float->SanPhamID}}">{{$GioHangCT_float->SanPhamTen}}</a></h6>
                            <p>{{$GioHangCT_float->SoLuong}}x - <span class="price">{{$GioHangCT_float->ThanhTien}}</span></p>
                        </li>
                        @endforeach
                        @endif
                        <li class="total">
                            <a href="{{route('client.cart')}}" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                            @if(isset($GioHang_float))
                            <span id="cart_money" class="float-right"><strong>Total</strong>: {{$GioHang_float->TongTien}}</span>
                            @else 
                            <span id="cart_money" class="float-right"><strong>Total</strong>: 0</span>
                            @endif
                        </li>
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->
