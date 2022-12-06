@extends('client.layout')

@section('content')
    <!-- Start My order  -->
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="special-menu text-center">
                <div class="button-group filter-button-group">
                    <button class="active" data-filter="*">Tất cả</button>
                    <button data-filter=".top-featured">Mới đặt</button>
                    <button data-filter=".best-seller">Đang xử lý</button>
                    <button data-filter=".best-seller">Thành công</button>
                    <button data-filter=".best-seller">Đã hủy</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Orders --}}
    @foreach($donhangs as $donhang)
    <div class="wishlist-box-main py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#{{$donhang->DonHangID}}</th>
                                    <th>Thời gian đặt: {{$donhang->ThoiGianTao}}    </th>
                                    <th></th>
                                    <th></th>
                                    <th>@if($donhang->DonHang_TinhTrang==1)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
									        <img class="img-fluid" src="/template/client/images/img-pro-01.jpg" alt="">
								        </a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
									        Lorem ipsum dolor sit amet
								        </a>
                                    </td>
                                    <td class="price-pr">
                                        <p>$ 80.0</p>
                                    </td>
                                    <td class="quantity-box">x1</td>
                                    <td class="price-pr">
                                        <p>$ 80.0</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
									        <img class="img-fluid" src="/template/client/images/img-pro-02.jpg" alt="">
								        </a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
									        Lorem ipsum dolor sit amet
								        </a>
                                    </td>
                                    <td class="price-pr">
                                        <p>$ 80.0</p>
                                    </td>
                                    <td class="quantity-box">x1</td>
                                    <td class="price-pr">
                                        <p>$ 80.0</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex gr-total justify-content-end">
                <h5>Grand Total</h5>
                <div class="h5 ml-5 mr-4"> $ 388 </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="wishlist-box-main py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#247899</th>
                                    <th>Đặt ngày: 21/11/2022    </th>
                                    <th></th>
                                    <th></th>
                                    <th>ĐÃ GIAO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
									        <img class="img-fluid" src="/template/client/images/img-pro-01.jpg" alt="">
								        </a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
									        Lorem ipsum dolor sit amet
								        </a>
                                    </td>
                                    <td class="price-pr">
                                        <p>$ 80.0</p>
                                    </td>
                                    <td class="quantity-box">x1</td>
                                    <td class="price-pr">
                                        <p>$ 80.0</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
									        <img class="img-fluid" src="/template/client/images/img-pro-02.jpg" alt="">
								        </a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
									        Lorem ipsum dolor sit amet
								        </a>
                                    </td>
                                    <td class="price-pr">
                                        <p>$ 80.0</p>
                                    </td>
                                    <td class="quantity-box">x1</td>
                                    <td class="price-pr">
                                        <p>$ 80.0</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex gr-total justify-content-end">
                <h5>Grand Total</h5>
                <div class="h5 ml-5 mr-4"> $ 388 </div>
            </div>
        </div>
    </div>
    <!-- End My order -->
@endsection

@section('title')
<h2>My order</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">My order</li>
                </ul>
@endsection
