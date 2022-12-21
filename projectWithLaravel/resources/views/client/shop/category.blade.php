@extends('client.layout')

@section('content')

    <!-- Start Shop Page  -->
    <div class="shop-box-inner" id="content">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-center text-sm-left">
                                <div class="toolbar-sorter-right">
                                    <span>Sort by </span>
                                    <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
									<option data-display="Select">All</option>
								</select>
                                </div>
                                <p>Showing all results</p>
                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-right">
                                <ul class="nav nav-tabs ml-auto">
                                    <li>
                                        <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">
                                        @foreach($products as $product_collect)
                                        @foreach($product_collect as $product)
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <div class="products-single fix">
                                                <div class="box-img-hover">
                                                    <div class="type-lb">
                                                        <p class="sale">{{$product->name}}</p>
                                                    </div>
                                                    <img src="{{'/template/admin/images/SanPhamBellezza/SanPham/'.$product->HinhAnh}}" class="img-fluid" alt="Image">
                                                    <div class="mask-icon">
                                                        <ul>
                                                            <li><a href="/shop/product-detail/{{$product->SanPhamID}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                            <li><a onclick="AddWishlist({{$product->SanPhamID}})" href="javascript:" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
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
                                        @endforeach
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="list-view">
                                    @foreach($products as $product_collect)
                                    @foreach($product_collect as $product)
                                    <div class="list-view-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                            <p class="new">{{$product->name}}</p>
                                                        </div>
                                                        <img src="{{'/template/admin/images/SanPhamBellezza/SanPham/'.$product->HinhAnh}}" class="img-fluid" alt="Image">
                                                        <div class="mask-icon">
                                                            <ul>
                                                                <li><a href="/shop/product-detail/{{$product->SanPhamID}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                                <li><a onclick="AddWishlist({{$product->SanPhamID}})" href="javascript:" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <h4>{{$product->SanPhamTen}}</h4>
                                                    <h5>{{$product->Gia}}</h5>
                                                    <p>{{$product->MoTa}}</p>
                                                    <a class="btn hvr-hover" onclick="AddCart({{$product->SanPhamID}})" href="javascript:">Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        <div class="search-product">
                            <form action="{{route('client.search')}}">
                                <input class="form-control" placeholder="Search here..." id="search" name="query" type="text">
                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>
                        </div>
                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Categories</h3>
                            </div>
                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                                <a href="/shop/all-product" class="list-group-item list-group-item-action">Tất cả sản phẩm</a>
                                
                                @foreach($categories as $category)
                                @if($category->parent_id==0)
                                    @foreach($categories as $category_c2)
                                        @if($category_c2->parent_id==$category->id)
                                        <div class="list-group-collapse sub-men">
                                            <a class="list-group-item list-group-item-action" href="{{'#sub-men'.$category->id}}" data-toggle="collapse" aria-expanded="true" aria-controls="{{'sub-men'.$category->id}}">{{$category->name}}</a>
                                            <div class="collapse show" id="{{'sub-men'.$category->id}}" data-parent="#list-group-men">
                                                <div class="list-group">
                                                    @foreach($categories as $category_child)
                                                    @if($category_child->parent_id==$category->id)
                                                    <a href="/shop/category/{{$category_child->id}}" class="list-group-item list-group-item-action">{{$category_child->name}}</a>
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @break($category->parent_id=-1)
                                        @endif
                                    @endforeach
                                    @if($category->parent_id==-1)
                                        @continue
                                    @endif
                                    <a href="/shop/category/{{$category->id}}" class="list-group-item list-group-item-action">{{$category->name}}</a>
                                    
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="filter-price-left">
                            <div class="title-left">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->
@endsection

@section('title')
<h2>{{$categorypage->name}}</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ul>
@endsection

