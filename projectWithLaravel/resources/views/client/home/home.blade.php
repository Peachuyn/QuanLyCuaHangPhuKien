{{-- Header --}}
@include('client.head')
{{-- Header --}}

{{-- Nav-bar --}}
@include('client.main-top')
{{-- Nav-bar --}}

{{-- Search --}}
@include('client.search')
{{-- Search --}}

<!-- Start Slider -->
<div id="slides-shop" class="cover-slides">
    <ul class="slides-container">
        <li class="text-center">
            <img src="/template/client/images/banner-01.png" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> Bellezza</strong></h1>
                        <p class="m-b-40">Tại Bellezza Stationery, chúng mình cung cấp các phụ kiện văn phòng phẩm, túi và balo canvas thêu <br> với hy vọng mang lại cho các bạn sản phẩm đẹp từ cái nhìn và đẹp cả với môi trường.
                        </p>
                        <p><a class="btn hvr-hover" href="{{route('client.all-product')}}">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
        <li class="text-center">
            <img src="/template/client/images/banner-02.png" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> Bellezza</strong></h1>
                        <p class="m-b-40">Bellezza mong muốn mang đến cho khách hàng những trải nghiệm tốt nhất, hài lòng nhất cho từng sản phẩm <br> giúp khách hàng thể hiện được cá tính, chất riêng một cách riêng nhất, đặc biệt và “xinh đẹp” nhất.
                        </p>
                        <p><a class="btn hvr-hover" href="{{route('client.all-product')}}">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
        <li class="text-center">
            <img src="/template/client/images/banner-03.png" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> Bellezza</strong></h1>
                        <p class="m-b-40">Nếu bạn cần tư vấn hãy để lại lời nhắn <br> chúng mình sẽ cố gắng phản hồi bạn sớm nhất có thể!
                        </p>
                        <p><a class="btn hvr-hover" href="{{route('client.all-product')}}">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <div class="slides-navigation">
        <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
</div>
<!-- End Slider -->

<!-- Start Categories  -->
<div class="categories-shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="/template/client/images/categories_img_01.png" alt="" />
                    <a class="btn hvr-hover" href="category/11">TÚI VẢI CANVAS</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="/template/client/images/categories_img_02.png" alt="" />
                    <a class="btn hvr-hover" href="category/12">VĂN PHÒNG PHẨM</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="/template/admin/images/SanPhamBellezza/SanPham/ViGapCute1.png" alt="" />
                    <a class="btn hvr-hover" href="category/9">VÍ</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Categories -->

<div class="box-add-products">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="offer-box-products">
                    <img class="img-fluid" src="/template/client/images/BG_Home1.png" alt="" />
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="offer-box-products">
                    <img class="img-fluid" src="/template/client/images/BG_Home2.png" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Start Products  -->
<div class="products-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>BE YOURSELF COLLECTION</h1>
                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="special-menu text-center">
                    <div class="button-group filter-button-group">
                        <button class="active" data-filter="*">All</button>
                        <button data-filter=".tuivai">Túi vải canvas</button>
                        <button data-filter=".vanphongpham">Văn phòng phẩm</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row special-list">
            @foreach($products as $product)
            <div class="col-lg-3 col-md-6 special-grid {{($product->id==12||$product->parent_id==12)?'vanphongpham':''}}{{($product->id==11||$product->parent_id==11)?'tuivai':''}}">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <div class="type-lb">
                            <p class="sale">{{$product->name}}</p>
                        </div>
                        <img src="{{'/template/admin/images/SanPhamBellezza/SanPham/'.$product->HinhAnh}}" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <ul>
                                <li><a href="/shop/product-detail/{{$product->SanPhamID}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                <li><a onclick="AddWishlist({{$product->SanPhamID}})"href="javascript:" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                            </ul>
                            <a class="cart" onclick="AddCart({{$product->SanPhamID}})" href="javascript:">Add to Cart</a>
                        </div>
                    </div>
                    <div class="why-text">
                        <h4>{{$product->SanPhamTen}}</h4>
                        <h5>{{$product->Gia}}</h5>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</div>
<!-- End Products  -->

<!-- Start Blog  -->
<div class="latest-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Bellezza Blog</h1>
                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="blog-box">
                    <div class="blog-img">
                        <img class="img-fluid" src="/template/admin/images/SanPhamBellezza/SanPham/TuiTheuHoaBlack3.png" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="title-blog">
                            <h3>Ý tưởng mix đồ với túi tote</h3>
                            <p>Với style năng động, bộ ba áo thun – quần jeans – túi tote chính là công thức áp dụng cho bất kỳ ai, 
                                không kể giới tính hay độ tuổi. Là công thức cơ bản nhất mà khi áp dụng, bạn sẽ auto ” chất “. 
                                Nếu bạn đi học hãy mặc áo thun quần jean/quần baggy. Outfit nơi công sở sẽ phù hợp với combo áo thun đóng thùng với quần culottes. 
                                Nếu đi chơi hay dạo phố, áo thun chân váy/quần sooc/yếm sẽ là sự kết hợp hoàn hảo.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="blog-box">
                    <div class="blog-img">
                        <img class="img-fluid" src="/template/admin/images/SanPhamBellezza/SanPham/TuiTheuDaisy3.png" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="title-blog">
                            <h3>Xu hướng Customizing theo sở thích cá nhân</h3>
                            <p>Việc thế hệ gen Z mua những sản phẩm Customize có thể bộc lộ cá tính và sở thích của họ đang trở thành điều hiển nhiên.
                                Customize phổ biến với những người coi trọng tính cá nhân vì nó cho phép bạn tạo ra mọi thứ theo yêu cầu.
                                Theo một nghiên cứu liên quan đến sản phẩm Customize, người tiêu dùng có xu hướng theo đuổi niềm vui không chỉ trong sản phẩm mà còn trong quá trình mua hàng.
                                 </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="blog-box">
                    <div class="blog-img">
                        <img class="img-fluid" src="/template/admin/images/SanPhamBellezza/SanPham/MocDanTuong3.png" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="title-blog">
                            <h3>Phụ kiện dễ thương mùa tựu trường</h3>
                            <p>Đi học mà đồ dùng học tập thật xinh xắn thì lại càng tăng thêm động lực học hành đúng không nhở.
                                Vậy thì mau ghé qua Bellezza sắm ngay dàn dụng cụ học tập, bút viết, bút nhớ dòng với đủ mọi màu sắc,
                                 mẫu mã hay chọn cho mình một chiếc túi custom với đa dạng mẫu mã mang đầy cá tính riêng để đồng hành cùng các cậu trên con đường học tập 
                                 giúp các cậu ghi chép, viết lách siêu hịn mà giá vô cùng hạt dẻ nha.
                                </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Blog  -->



{{-- end --}}
@include('client.end')
{{-- end --}}

{{-- Footer --}}
@include('client.foot')
{{-- Footer --}}