@extends('Themes.layout_staff.app')
@section('content')
<style>
    #listproduct .product-item1 .card-body img {
        width: 145px;
        height: auto;
        object-fit: cover;
    }

    .card-body {
        max-height: 400px;
        padding: 10px;
    }

    .icon-bell:before {
        content: "\f0f3";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
    }

    .input-group {
        position: relative;
    }

    .results {
        list-style-type: none;
        padding: 0;
        margin-top: 10px;
        border: 1px solid #ccc;
        max-height: 150px;
        overflow-y: auto;
        display: none;
        position: absolute;
        width: 80%;
        background-color: white;
        z-index: 1000;
    }

    .results li {
        padding: 10px;
        border-bottom: 1px solid #ccc;
        cursor: pointer;
    }

    .results li:last-child {
        border-bottom: none;
    }

    .results li:hover {
        background-color: #f0f0f0;
    }

    .no-results {
        text-align: center;
        color: #888;
    }

    .product-item {
        display: flex;
        flex-wrap: wrap;
    }

    .alert {
        width: calc(33.33% - 20px);
        margin-right: 20px;
        padding: 15px;
        box-sizing: border-box;
        position: relative;
    }

    .alert:last-child {
        margin-right: 0;
    }

    .closebtn {
        margin-left: 20px;
        position: absolute;
        top: 30%;
        right: 10px;
        cursor: pointer;
    }

    .alert strong {
        font-weight: bold;
    }

    .alert span {
        margin-left: 10px;
    }

    .closebtn:hover{
        color: red;
        font-weight: bold;

    }
    .custom-input {
        width: 100px;
        padding: 5px;
        text-align: center;
        font-size: 14px;
        border-radius: 5px;
    }

    .product-name {
    font-size: 13px;
    margin-top: 5px;
    margin-bottom: 0px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 80px;
}
</style>
<!-- Content section -->
<div class=" container-fluid mt-4">
    <div class="row" id="row">
        <!-- Left Column: Product List -->
        <div class="col-lg-8" id="row1">
            <div class="card">
                <div class="card-header">Product List</div>
                <div class="card-body" style="overflow-y: scroll;">
                    <!-- Product items go here -->
                    <div class="row">
                        @if ($product)
                        @foreach ($product as $item )
                        <div class="col-md-2 mb-3 ">
                            <div class="product-item1 ">
                                <div class="card-body listproduct" data-id="{{ $item->id }}">
                                    <img src="{{ asset($item->images[0]->image_path) }}" alt=""
                                        style="width: 145px; height: 60px;">
                                    <p style="font-size: 13px; margin-top: 5px; margin-bottom: 0px" class="card-title product-name">
                                        {{ $item->name }}</p>
                                    <div style="display: flex; justify-content:space-between; ">
                                        <p style="font-size: 13px; margin-top: 5px; margin-bottom: 0px"
                                            class="card-title">{{ number_format($item->priceBuy) }}đ</p>
                                        <P style="margin: 0px; cursor: pointer;"><i
                                                style="font-size: 15px; color: rgb(105, 97, 223)"
                                                class="fas fa-shopping-cart fa-lg"></i></P>
                                    </div>

                                </div>
                            </div>
                        </div>

                        @endforeach

                        @endif
                    </div>
                    <!-- Additional row within col-lg-8 -->
                </div>
            </div>
            <div class="card" id="regular-selling-content1" style="display: none;">
            </div>
            {{-- thanh toán --}}
            <div class="row mt-4 main_note">
                <div class="col-lg-8 mt-4 mb-4">
                    <div class="  product-item">
                        @if($cart)
                        @foreach ($cart as $item)
                        <div class=" col-12 alert d-flex "
                            style="justify-content: space-between; margin: 0px; padding-bottom: 0px">
                            <div class="closebtn" data-id="{{ $item->id }}" >&times;</div>
                            <div class="d-flex" style=" margin-right: 109px;
                                width: 100%; justify-content: space-between">
                                <strong style="width: 130px;">{{ $item->product->name }}
                                    <p style="margin: 0; font-size: 13px; color: #888">{{
                                        number_format($item->product->priceBuy) }}đ </p>
                                </strong> <span><input type="number" min="1" class="custom-input" data-id={{
                                        $item->product->id }}
                                    value="{{ $item->amount }}"> </span> <span style="width: 80px;">{{
                                    number_format($item->product->priceBuy * $item->amount )}}đ</span>
                            </div>
                        </div>

                        @endforeach
                        @endif

                    </div>
                </div>
                <div class="col-lg-4 mt-4 mb-4">
                    <ul class="list-unstyled">
                        <li class=" d-flex justify-content-between align-items-center">
                            Tổng tiền hàng
                            <span class="badge badge-primary badge-pill" id="total-amount">{{ number_format($sum) }}</span>
                        </li>
                        <li class=" d-flex justify-content-between align-items-center mt-2">
                            Giảm giá
                            <span class="badge badge-primary badge-pill" id="discount">0</span>
                        </li>
                        <li class=" d-flex justify-content-between align-items-center mt-2">
                            Khách cần trả
                            <span class="badge badge-primary badge-pill" id="total-to-pay">{{ number_format($sum) }}</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- Right Column: Customer Information and Payment Method 123-->
        @include('Themes.pages.layout_staff.delivery-selling')

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        var $j = jQuery.noConflict();

$j(document).ready(function() {

    $j("#search").on("keyup", function() {
        var query = $j(this).val().toLowerCase();
        var hasResults = false;

        if (query.length > 0) {
            $j("#results").show();
            $j("#results li").each(function() {
                var name = $j(this).text().toLowerCase();
                if (name.includes(query)) {
                    $j(this).show();
                    hasResults = true;
                } else if (!$j(this).hasClass("no-results")) {
                    $j(this).hide();
                }
            });

            if (hasResults) {
                $j(".no-results").hide();
            } else {
                $j(".no-results").show();
            }
        } else {
            $j("#results").hide();
        }
    });


   // Xử lý sự kiện click trên sản phẩm để thêm vào giỏ hàng
    $j(".listproduct").on("click", function(e) {
        e.preventDefault();
        var productId = $j(this).data("id");
        $j.ajax({
            url: '{{ route('staff.cart.add') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                amount: 1
            },
            success: function(response) {
                updateCart(response.cart);
                var total_amount = $j('#total-amount');
                total_amount.text(response.sum);
                var total_amount_to_pay = $j('#total-to-pay');
                total_amount_to_pay.text(response.sum);
            },
            error: function(xhr) {
                alert(xhr.responseJSON.error);
            }
        });
    });


    $(document).on('input', '.custom-input', function(e) {
        e.preventDefault();
        var productId = $j(this).data("id");
        var amount = $j(this).val();

        $j.ajax({
            url: '{{ route('staff.cart.add') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                amount: amount
            },
            success: function(response) {
                updateCart(response.cart);
                var total_amount = $j('#total-amount');
                total_amount.text(response.sum);
                var total_amount_to_pay = $j('#total-to-pay');
                total_amount_to_pay.text(response.sum);
            },
            error: function(xhr) {
                alert(xhr.responseJSON.error);
            }
        });
    });


    $(document).on('click', '.closebtn', function(e) {
        e.preventDefault();
        var cart = $(this).data('id');
        $j.ajax({
            url: '{{ route('staff.cart.remove') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                cart: cart,
            },
            success: function(response) {
                updateCart(response.cart);
                var total_amount = $j('#total-amount');
                total_amount.text(response.sum);
                var total_amount_to_pay = $j('#total-to-pay');
                total_amount_to_pay.text(response.sum);
            },
            error: function(xhr) {
                alert(xhr.responseJSON.error);
            }
        });

    })

    $j("#results").on("click", "li", function() {
        if (!$j(this).hasClass("no-results")) {
            var fullName = $j(this).data("fullname");
            var email = $j(this).data("email");
            var phone = $j(this).data("phone");
            var address = $j(this).data("address");
            $j("#name").val(fullName);
            $j("#email").val(email);
            $j("#phoneNumber").val(phone);
            $j("#address").val(address);
            $j("#results").hide();
        }
    });

    function updateCart(cart) {
        var cartItems = $j('.product-item');
        cartItems.empty();
            if(cart.length === 0) {
                cartItems.append('<p>Your cart is empty.</p>');
            } else {
                $.each(cart, function(id, details) {
                    var cartItem = '<div class="col-12 alert d-flex" style="justify-content: space-between; margin: 0px; padding-bottom: 0px;">' +
                    '<div '+ 'data-id = "' + details.id + '"'  + ' class="closebtn">&times;</div>' +
                    '<div class="d-flex" style="margin-right: 109px; width: 100%; justify-content: space-between;">' +
                        '<strong style="width: 130px;">' + details.product_name +
                            '<p style="margin: 0; font-size: 13px; color: #888;">' + details.priceBuy + 'đ</p>' +
                        '</strong>' +
                        '<span><input type="number"' + 'data-id = "' + details.product_id + '"'  + '  min="1" class="custom-input" value="' + details.amount + '"></span>' +
                        '<span style="width: 80px;">' + (details.priceBuy * details.amount) + 'đ</span>' +
                    '</div>' +
                '</div>';
                    cartItems.append(cartItem);
                });
            }
    }
});
    </script>
    @endsection
