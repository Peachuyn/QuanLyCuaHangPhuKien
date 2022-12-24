@extends('client.layout')

@section('content')
    <!-- Start Cart  -->
    @include('admin/alert')
    <div class="cart-box-main">
        <div class="container">
            <form action="" method="POST">
                @csrf
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing address</h3>
                        </div>
                            <div class="mb-3">
                                <label for="name">Name *</label>
                                <div class="input-group">
                                    <input name="name" type="text" class="form-control" id="name" placeholder="" value="{{$customer->TenKhachHang}}" required>
                                    <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email Address *</label>
                                <input readonly type="email" class="form-control" id="email" placeholder="" value="{{$customer->email}}">
                                <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address *</label>
                                <input name="address" type="text" class="form-control" id="address" placeholder="" required>
                                <div class="invalid-feedback"> Please enter your shipping address. </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="country">Tỉnh *</label>
                                    <select class="wide w-100" id="tinh" name="tinh">
                                        @foreach($tinhs as $tinh)
									    <option value="{{$tinh->TinhID}}">{{$tinh->TenTinh}}</option>
                                        @endforeach
								    </select>
                                    <div class="invalid-feedback"> Please select a valid province. </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">Huyện *</label>
                                    <select class="wide w-100" id="quan" name="quan">
                                        @foreach($quans as $quan)
									    <option value="{{$quan->QuanID}}">{{$quan->TenQuan}}</option>
                                        @endforeach
								    </select>
                                    <div class="invalid-feedback"> Please provide a valid distric. </div>
                                </div>
                            </div>  
                            <hr class="mb-4">
                            <div class="title"> <span>Payment</span> </div>
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                                    <label class="custom-control-label" for="credit">Trả tiền mặt khi nhận hàng</label>
                                </div>
                            </div>
                            <hr class="mb-1">
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="shipping-method-box">
                                <div class="title-left">
                                    <h3>Shipping Method</h3>
                                </div>
                                <div class="mb-4 shipping">
                                    <div class="custom-control custom-radio">
                                        <input value="0" id="shippingOption1" name="shipping_option" class="custom-control-input" checked="checked" type="radio">
                                        <label class="custom-control-label" for="shippingOption1">Giao hàng tiết kiệm</label> <span class="float-right font-weight-bold">FREE</span> 
                                    </div>
                                    <div class="ml-4 mb-2 small">(3-7 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input value="20000" id="shippingOption2" name="shipping_option" class="custom-control-input" type="radio">
                                        <label class="custom-control-label" for="shippingOption2">Giao hàng tiêu chuẩn</label> <span class="float-right font-weight-bold">20000</span> </div>
                                    <div class="ml-4 mb-2 small">(3-4 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input value="30000" id="shippingOption3" name="shipping_option" class="custom-control-input" type="radio">
                                        <label class="custom-control-label" for="shippingOption3">Giao hàng nhanh</label> <span class="float-right font-weight-bold">30000</span> </div>
                                        <div class="ml-4 mb-2 small">(1-2 business days)</div>
                                
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Shopping cart</h3>
                                </div>
                                <div class="rounded p-2 bg-light">
                                    @foreach($cart_details as $cart_detail)
                                        <div class="media mb-2 ">
                                            <div class="media-body"> <a href="detail.html">{{$cart_detail->SanPhamTen}}</a>
                                                <div class="small text-muted">Price: {{$cart_detail->Gia}} <span class="mx-2">|</span> Qty: {{$cart_detail->SoLuong}} <span class="mx-2">|</span> Subtotal: {{$cart_detail->ThanhTien}}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Your order</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Product</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold cart-cost">{{$cart->TongTien}}</div>
                                </div>
                                <div class="d-flex">
                                    <h4>Shipping Cost</h4>
                                    <div class="ml-auto font-weight-bold shipping-cost"> Free </div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Grand Total</h5>
                                    <div class="ml-auto h5 total-cost">{{$cart->TongTien}}</div>
                                </div>
                                <hr> </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"> <button style="color: #f8f9fa;" class="ml-auto py-2 px-3 btn hvr-hover">Place Order</button> </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    <!-- End Cart -->
@endsection

@section('title')
<h2>Checkout</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ul>
@endsection
