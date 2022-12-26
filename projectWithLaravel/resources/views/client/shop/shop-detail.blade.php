@extends('client.layout')

@section('content')
    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            @empty($product_images)
                            @foreach($product_images as $image)
                            <div class="carousel-item <?php if($flag==0){echo 'active'; $flag=1;}?>"> <img class="d-block w-100" src="{{'/template/admin/images/SanPhamBellezza/SanPham/'.$image->link}}" alt="First slide"> </div>
                            @endforeach
                            @else
                            <div class="carousel-item active"> <img class="d-block w-100" src="{{'/template/admin/images/SanPhamBellezza/SanPham/'.$product->HinhAnh}}" alt="First slide"> </div>
                            @endempty
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
						<i class="fa fa-angle-left" aria-hidden="true"></i>
						<span class="sr-only">Previous</span> 
					</a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
						<i class="fa fa-angle-right" aria-hidden="true"></i> 
						<span class="sr-only">Next</span> 
					</a>
                        <ol class="carousel-indicators">
                            @foreach($product_images as $image)
                            <li data-target="#carousel-example-1" data-slide-to="1" class="active">
                                <img class="d-block w-100 img-fluid" src="{{'/template/admin/images/SanPhamBellezza/SanPham/'.$image->link}}" alt="" />
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2>{{$product->SanPhamTen}}</h2>
                        <h5>{{$product->Gia}}</h5>
                        <p class="available-stock"><span> More than {{$product->SoLuong}} available / <a href="#">{{$product->SoLuong_Ban}} sold </a></span><p>
						<h4>Short Description:</h4>
						<p>{{$product->MoTa}}</p>
						<ul>
							<li>
								<div class="form-group quantity-box">
									<label class="control-label">Quantity</label>
									<input class="form-control quantity" name="quantity" value="1" min="1" max="20" type="number">
								</div>
							</li>
						</ul>

						<div class="add-to-btn">
							<div class="add-comp">
								<a class="btn hvr-hover" onclick="AddCart({{$product->SanPhamID}})" href="javascript:" data-fancybox-close="">Add to cart</a>

								<a class="btn hvr-hover" onclick="AddWishlist({{$product->SanPhamID}})"href="javascript:" ><i class="fas fa-heart"></i> Add to wishlist</a>
							</div>
							<div class="share-bar">
								<a class="btn hvr-hover" href="https://www.facebook.com/bellezzastationery"><i class="fab fa-facebook" aria-hidden="true"></i></a>
								<a class="btn hvr-hover" href="https://shopee.vn/bellezzam22"><i class="fas fa-shopping-cart" aria-hidden="true"></i></a>
							</div>
						</div>
                    </div>
                </div>
            </div>
			
			<div class="row my-5">
				<div class="card card-outline-secondary my-4">
					
				  </div>
			</div>

            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Featured Products</h1>
                    </div>
                    <div class="featured-products-box owl-carousel owl-theme">
                        @foreach($products as $product)
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
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
        </div>
    </div>
<!-- End Cart -->
@endsection

@section('title')
<h2>{{$tensanpham}}</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Shop Detail</li>
                </ul>
@endsection
