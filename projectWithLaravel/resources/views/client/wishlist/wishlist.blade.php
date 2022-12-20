@extends('client.layout')

@section('content')
<!-- Start Wishlist  -->
<div class="wishlist-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Images</th>
                                <th>Product Name</th>
                                <th>Unit Price </th>
                                <th>Stock</th>
                                <th>Add Item</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td class="thumbnail-img">
                                    <a href="#">
                                        <img class="img-fluid" src="{{'/template/admin/images/SanPhamBellezza/SanPham/'.$product->HinhAnh}}" alt="" />
                                    </a>
                                </td>
                                <td class="name-pr">
                                    <a href="#">
                                        {{$product->SanPhamTen}}
                                    </a>
                                </td>
                                <td class="price-pr">
                                    <p>{{$product->Gia}}</p>
                                </td>
                                <td class="quantity-box">In Stock</td>
                                <td class="add-pr">
                                    <a class="btn hvr-hover" href="#">Add to Cart</a>
                                </td>
                                <td class="remove-pr">
                                    <a href="#">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Wishlist -->
@endsection

@section('title')
<h2>Wishlist</h2>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Shop</a></li>
    <li class="breadcrumb-item active">Wishlist</li>
</ul>
@endsection