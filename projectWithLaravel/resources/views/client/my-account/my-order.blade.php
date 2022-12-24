@extends('client.layout')

@section('content')
@include('admin/alert')

    <!-- Start My order  -->
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="special-menu text-center">
                <div class="button-group filter-button-group">
                    <button class="px-5" data-filter="*">Tất cả</button>
                    {{-- <button data-filter=".top-featured">Mới đặt</button>
                    <button data-filter=".best-seller">Đang xử lý</button>
                    <button data-filter=".best-seller">Thành công</button>
                    <button data-filter=".best-seller">Đã hủy</button> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- Orders --}}
    @foreach($donhangs as $donhang)
    <div class="wishlist-box-main py-4 top-featured">
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
                                    <th>@if($donhang->DonHang_TinhTrang==0) Mới đặt
                                        @elseif($donhang->DonHang_TinhTrang==1) Đang được giao
                                        @elseif($donhang->DonHang_TinhTrang==2) Thành công
                                        @else Đã hủy
                                        @endif
                                    </th>
                                </tr>
                            </thead>
                            <tbody style="background-color: #e6dbf9;">
                                @foreach($chitietdonhangs as $chitietdonhang)
                                @foreach($chitietdonhang as $chitiet)
                                @if($chitiet->DonHangID==$donhang->DonHangID)
                                    <tr>
                                        <td class="thumbnail-img">
                                            <a href="/shop/product-detail/{{$chitiet->SanPhamID}}">
                                                <img class="img-fluid" src="{{'/template/admin/images/SanPhamBellezza/SanPham/'.$chitiet->HinhAnh}}" alt="">
                                            </a>
                                        </td>
                                        <td class="name-pr">
                                            <a href="/shop/product-detail/{{$chitiet->SanPhamID}}">
                                               {{$chitiet->SanPhamTen}}
                                            </a>
                                        </td>
                                        <td class="price-pr">
                                            <p>{{$chitiet->Gia}} VND</p>
                                        </td>
                                        <td class="quantity-box">x{{$chitiet->SoLuong}}</td>
                                        <td class="price-pr">
                                            <p>{{$chitiet->Gia*$chitiet->SoLuong}}</p>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex gr-total justify-content-end">
                <h5>Tổng tiền</h5>
                <div class="h5 ml-5 mr-4"> {{$donhang->TongTien}} </div>
            </div>
        </div>
    </div>
    @endforeach
    

    <!-- End My order -->
@endsection

@section('title')
<h2>My order</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">My order</li>
                </ul>
@endsection
