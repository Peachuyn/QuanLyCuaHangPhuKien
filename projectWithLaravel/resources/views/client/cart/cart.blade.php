@extends('client.layout')

@section('content')
@include('admin/alert')

<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Images</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="product-{{$product->SanPhamID}}">
                                <td class="thumbnail-img">
                                    <a href="/shop/product-detail/{{$product->SanPhamID}}">
                                        <img class="img-fluid" src="{{'/template/admin/images/SanPhamBellezza/SanPham/'.$product->HinhAnh}}" alt="" />
                                    </a>
                                </td>
                                <td class="name-pr">
                                    <a href="/shop/product-detail/{{$product->SanPhamID}}">
                                        {{$product->SanPhamTen}}
                                    </a>
                                </td>
                                <td class="price-pr">
                                    <p>{{$product->Gia}}</p>
                                </td>
                                <td class="quantity-box quantity-cart">
                                    <input readonly type="number" size="4" value="{{$product->SoLuong}}" min="0" step="1" class="c-input-text qty text">
                                </td>
                                <td class="total-pr">
                                    <p>{{$product->ThanhTien}}</p>
                                </td>
                                <td class="remove-pr">
                                    <a onclick="DelCart({{$product->SanPhamID}})" href="javascript:">
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

        <div class="row my-5">
            <div class="col-lg-8 col-sm-12"></div>
            <div class="col-lg-4 col-sm-12">
                <div class="order-box">
                    <h3>Order summary</h3>
                    <div class="d-flex">
                        <h4>Sub Total</h4>
                        <div class="ml-auto font-weight-bold total-cost">@if(isset($cart)){{$cart->TongTien}}@else 0 @endif</div>
                    </div>
                    <div class="d-flex">
                        <h4>Shipping Cost</h4>
                        <div class="ml-auto font-weight-bold">.......</div>
                    </div>
                    <hr>
                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        <div class="ml-auto h5 total-cost">@if(isset($cart)){{$cart->TongTien}}@else 0 @endif</div>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="col-12 d-flex shopping-box"><a href="{{route('client.checkout')}}" class="ml-auto btn hvr-hover">Checkout</a> </div>
        </div>

    </div>
</div>
<!-- End Cart -->
@endsection

@section('title')
<h2>Cart</h2>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Shop</a></li>
    <li class="breadcrumb-item active">Cart</li>
</ul>
@endsection