
<!-- ALL JS FILES -->
<script src="/template/client/js/jquery-3.2.1.min.js"></script>
<script src="/template/client/js/popper.min.js"></script>
<script src="/template/client/js/bootstrap.min.js"></script>
<!-- ALL PLUGINS -->
<script src="/template/client/js/jquery.superslides.min.js"></script>
<script src="/template/client/js/bootstrap-select.js"></script>
<script src="/template/client/js/inewsticker.js"></script>
<script src="/template/client/js/bootsnav.js."></script>
<script src="/template/client/js/images-loded.min.js"></script>
<script src="/template/client/js/isotope.min.js"></script>
<script src="/template/client/js/owl.carousel.min.js"></script>
<script src="/template/client/js/baguetteBox.min.js"></script>
<script src="/template/client/js/jquery-ui.js"></script>
<script src="/template/client/js/jquery.nicescroll.min.js"></script>
<script src="/template/client/js/form-validator.min.js"></script>
<script src="/template/client/js/contact-form-script.js"></script>
<script src="/template/client/js/custom.js"></script>
<script>
        function AddCart(id){
            var product_qty=parseInt($('.quantity').val());
            if(isNaN(product_qty)){
                product_qty=1;
            }
            $.ajax({
                url:'/shop/add_to_cart/'+id,
                type:'GET',
                data: {
                    'product_id' : id,
                    'product_qty': product_qty,
                },
                success: function(response){
                    //Trường hợp trùng sản phẩm (ID giỏ hàng CT tồn tại)
                    if($(`#${response.GioHangCT[0].GioHangChiTietID}`).length){
                         $(`#${response.GioHangCT[0].GioHangChiTietID}`).html(`
                            <li class="product-list" >
                                <a href="#" class="photo" style="padding: 0 !important;
                                                            margin-right: 15px;
                                                            float: left;
                                                            display: block;
                                                            width: 50px;
                                                            height: 50px;
                                                            left: 15px;
                                                            top: 15px;">
                                    <img src="/template/admin/images/SanPhamBellezza/SanPham/${response.GioHangCT[0].HinhAnh}" class="cart-thumb" alt="" />
                                </a>
                                <h6><a href="#">${response.GioHangCT[0].SanPhamTen}</a></h6>
                                <p>${response.GioHangCT[0].SoLuong}x - <span class="price">${response.GioHangCT[0].ThanhTien}</span></p>
                            </li> 
                         `)
                    }
                    else{      
                        $('.total').before(`
                        <li class="product-list" id="${response.GioHangCT[0].GioHangChiTietID}">
                                <a href="#" class="photo" style="padding: 0 !important;
                                                            margin-right: 15px;
                                                            float: left;
                                                            display: block;
                                                            width: 50px;
                                                            height: 50px;
                                                            left: 15px;
                                                            top: 15px;">
                                    <img src="/template/admin/images/SanPhamBellezza/SanPham/${response.GioHangCT[0].HinhAnh}" class="cart-thumb" alt="" />
                                </a>
                                <h6><a href="#">${response.GioHangCT[0].SanPhamTen}</a></h6>
                                <p>${response.GioHangCT[0].SoLuong}x - <span class="price">${response.GioHangCT[0].ThanhTien}</span></p>
                            </li> 
                        `
                        );
                    }
                    //Chỉnh số lượng của cart
                    $('#cart_count').html(response.GioHang[0].SoLuong);
                    //Chỉnh tổng tiền
                    $('#cart_money').html(`<strong>Total</strong>: ${response.GioHang[0].TongTien}`);
                }
            })
        }
        function AddWishlist(id){
            $.ajax({
                url:'/shop/add_wishlist/'+id,
                type:'GET',
                data: {
                    'product_id' : id,
                },
                success: function(response){
                    alert(response.status);
                }
            })
        }

        function DelWishlist(id){
            console.log(id);
            $.ajax({
                url:'/shop/del_wishlist/'+id,
                type:'GET',
                data: {
                    'product_id' : id,
                },
                success: function(response){
                    alert(response.status);
                    
                }
            })
        }

    </script>
</body>

</html>

