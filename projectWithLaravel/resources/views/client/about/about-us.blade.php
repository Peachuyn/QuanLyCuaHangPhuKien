@extends('client.layout')

@section('content')
    <!-- Start About Page  -->
    <div class="about-box-main">
        <div class="container">
            <div class="row">
				<div class="col-lg-6">
                    {{-- <div class="banner-frame"> <img class="img-fluid" src="/template/client/images/about-img.jpg" alt="" /> --}}
                        <div class="banner-frame"> <img class="img-fluid" src="/template/admin/images/Home_img/BG_Aboutus.png" alt="" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <br>
                    <br>
                    <h2 class="noo-sh-title-top">Hi! This is <span>Bellezza</span></h2>
                    <br>
                    <p>Bellezza được lấy cảm hứng từ “Beauty” nghĩa là cái đẹp. Thật vật, Bellezza không chỉ mang đến những sản phẩm đẹp từ cái nhìn, đẹp đến ý nghĩa và đẹp cả với môi trường. Giữa lấy cái đẹp, cái thuần tuý trong vô vạn bụi bẩn xoay vần.
                    </p>
                    <p>Với mũi nhọn là các sản phẩm tự thiết kế kết hợp với việc bảo vệ môi trường - một vấn đề mà ngày càng được các bạn trẻ quan tâm nhiều hơn. Tụi mình dùng các sản phẩm từ vải canva, hoặc các chất liệu có thể may thêu và tái sử dụng nhiều lần được để làm sản phẩm đặc trưng cho cửa hàng. Bên cạnh đó là các sản phẩm văn phòng dùng hằng ngày nhưng với các thiết kế mới lạ, độc đáo hơn so với sản phẩm truyền thống. </p>
					{{-- <a class="btn hvr-hover" href="#">Read More</a> --}}
                </div>
            </div>
            <div class="row my-5">
                <div class="col-sm-6 col-lg-4">
                    <div class="service-block-inner">
                        <h3>Sản phẩm tự thiết kế</h3>
                        <p>Bellezza không chỉ mang đến những sản phẩm đẹp từ cái nhìn, đẹp đến ý nghĩa và đẹp cả với môi trường. </p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="service-block-inner">
                        <h3>Xu hướng</h3>
                        <p>Bellezza đại diện cho xu hướng thời trang hiện đại thể hiện cá tính của người dùng và gắn liền với bảo vệ môi trường.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="service-block-inner">
                        <h3>Khác biệt</h3>
                        <p>Phong cách luôn đổi mới từng ngày tạo được nét riêng ngay cả với những sản phẩm hằng ngày, quen thuộc trong đời sống. </p>
                    </div>
                </div> 
            </div>
            <div class="row my-4">
                <div class="col-12">
                    <h2 class="noo-sh-title">Meet Our Team</h2>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="hover-team">
                        <div class="our-team"> <img src="/template/client/images/img-1.jpg" alt="" />
                            <div class="team-content">
                                <h3 class="title">Lê Thị Phương Duyên</h3> <span class="post">CFO - Chief Financial Officer</span> </div>
                            <ul class="social">
                                <li>
                                    <a href="https://www.facebook.com/le.thanhnguyen.1044" class="fab fa-facebook"></a>
                                </li>
                            </ul>
                            <div class="icon"> <i class="fa fa-plus" aria-hidden="true"></i> </div>
                        </div>
                        <div class="team-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent urna diam, maximus ut ullamcorper quis, placerat id eros. Duis semper justo sed condimentum rutrum. Nunc tristique purus turpis. Maecenas vulputate. </p>
                        </div>
                        <hr class="my-0"> </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="hover-team">
                        <div class="our-team"> <img src="/template/client/images/img-2.jpg" alt="" />
                            <div class="team-content">
                                <h3 class="title">Đào Thị Thu Uyên</h3> <span class="post">COO - Chief Operations Officer</span> </div>
                            <ul class="social">
                                <li>
                                    <a href="https://www.facebook.com/peachuyn" class="fab fa-facebook"></a>
                                </li>
                            </ul>
                            <div class="icon"> <i class="fa fa-plus" aria-hidden="true"></i> </div>
                        </div>
                        <div class="team-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent urna diam, maximus ut ullamcorper quis, placerat id eros. Duis semper justo sed condimentum rutrum. Nunc tristique purus turpis. Maecenas vulputate. </p>
                        </div>
                        <hr class="my-0"> </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="hover-team">
                        <div class="our-team"> <img src="/template/client/images/img-3.jpg" alt="" />
                            <div class="team-content">
                                <h3 class="title">Ma Thị Thu Hiền</h3> <span class="post">CCO - Chief Commercial Officer</span> </div>
                            <ul class="social">
                                <li>
                                    <a href="https://www.facebook.com/glendaa.hinf/" class="fab fa-facebook"></a>
                                </li>
                            </ul>
                            <div class="icon"> <i class="fa fa-plus" aria-hidden="true"></i> </div>
                        </div>
                        <div class="team-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent urna diam, maximus ut ullamcorper quis, placerat id eros. Duis semper justo sed condimentum rutrum. Nunc tristique purus turpis. Maecenas vulputate. </p>
                        </div>
                        <hr class="my-0"> </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="hover-team">
                        <div class="our-team"> <img src="/template/client/images/img-4.jpg" alt="" />
                            <div class="team-content">
                                <h3 class="title">Huỳnh Yến Anh</h3> <span class="post">CMO - Chief Marketing Officer</span> </div>
                            <ul class="social">
                                <li>
                                    <a href="https://www.facebook.com/ensdayyy.010702" class="fab fa-facebook"></a>
                                </li>
                            </ul>
                            <div class="icon"> <i class="fa fa-plus" aria-hidden="true"></i> </div>
                        </div>
                        <div class="team-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent urna diam, maximus ut ullamcorper quis, placerat id eros. Duis semper justo sed condimentum rutrum. Nunc tristique purus turpis. Maecenas vulputate. </p>
                        </div>
                        <hr class="my-0"> </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About Page -->
@endsection

@section('title')
<h2>ABOUT US</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">ABOUT US</li>
                </ul>
@endsection
