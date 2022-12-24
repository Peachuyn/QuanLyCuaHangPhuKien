@extends('client.layout')

@section('content')
    <!-- Start Gallery  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Our Gallery</h1>
                        <p>Bellezza không chỉ mang đến những sản phẩm đẹp từ cái nhìn, đẹp đến ý nghĩa và đẹp cả với môi trường. Giữa lấy cái đẹp, cái thuần tuý trong vô vạn bụi bẩn xoay vần.</p>
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
                            <img src="{{'/template/admin/images/SanPhamBellezza/SanPham/'.$product->HinhAnh}}" class="img-fluid" alt="Image">
                            <div class="mask-icon">
                                <ul>
                                    <li><a href="/shop/product-detail/{{$product->SanPhamID}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                    <li><a onclick="AddWishlist({{$product->SanPhamID}})"href="javascript:" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Gallery  -->
@endsection

@section('title')
<h2>Services</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Services</li>
                </ul>
@endsection
