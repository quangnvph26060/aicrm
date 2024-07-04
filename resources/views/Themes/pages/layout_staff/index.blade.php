@extends('Themes.layout_staff.app')
@section('content')
<style>
        #listproduct .product-item1 .card-body img {
        width: 145px;
        height: auto;
        object-fit: cover;
    }

    #listproduct .product-item1 .card-body {
        text-align: center;
    }
</style>
<!-- Content section -->
<div class=" container-fluid mt-4">
    <div class="row" id="row">
        <!-- Left Column: Product List -->
        <div class="col-lg-8" id="row1">
            <div class="card" id="delivery-selling-content1" style="display: none;">
                <div class="card-header">Product List</div>
                <div class="card-body">
                    <!-- Product items go here -->
                    <div class="row">
                        @if ($product)
                        @foreach ($product as $item )
                        <div class="col-md-3 mb-4" id="listproduct">
                            <div class="product-item1">
                                <div class="card-body">
                                    <img src="{{ asset($item->images[0]->image_path) }}"
                                        alt="" style="width: 145px; height: 109px;">
                                    <p class="card-title">{{ $item->name }}</p>

                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary quantity-control" type="button"
                                                onclick="decreaseQuantity(this)">-</button>
                                        </div>
                                        <input type="text" class="form-control quantity" value="1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary quantity-control" type="button"
                                                onclick="increaseQuantity(this)">+</button>
                                        </div>

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
                    <div class="product-item">
                        <div class="form-group">

                            <input type="text" class="form-control" id="note" placeholder="Enter note">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mb-4">

                    <li class=" d-flex justify-content-between align-items-center">
                        Tổng tiền hàng
                        <span class="badge badge-primary badge-pill">4,924,624</span>
                    </li>
                    <li class=" d-flex justify-content-between align-items-center mt-2">
                        Giảm giá
                        <span class="badge badge-primary badge-pill">0</span>
                    </li>
                    <li class=" d-flex justify-content-between align-items-center mt-2">
                        Khách cần trả
                        <span class="badge badge-primary badge-pill">4,924,624</span>
                    </li>

                </div>
            </div>
        </div>
        <!-- Right Column: Customer Information and Payment Method 123-->
        @include('Themes.pages.layout_staff.delivery-selling')
        {{-- <div class="col-lg-4" id="regular-selling-content" style="display: none;">
            <div class="card">
                <div class="card-header">Bán nhanh</div>
                <div class="card-body">
                    <!-- Product items go here -->
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <div class="product-item1">
                                <div class="card-body">
                                    <img src="https://icdn.24h.com.vn/upload/2-2024/images/2024-06-22/255x170/1-495-1719050831-692-width740height495.jpg"
                                        alt="">
                                    <p class="card-title">Product 1</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="product-item1">
                                <div class="card-body">
                                    <img src="https://icdn.24h.com.vn/upload/2-2024/images/2024-06-22/255x170/1-495-1719050831-692-width740height495.jpg"
                                        alt="">
                                    <p class="card-title">Product 1</p>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="product-item1">
                                <div class="card-body">
                                    <img src="https://icdn.24h.com.vn/upload/2-2024/images/2024-06-22/255x170/1-495-1719050831-692-width740height495.jpg"
                                        alt="">
                                    <p class="card-title">Product 1</p>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="product-item1">
                                <div class="card-body">
                                    <img src="https://icdn.24h.com.vn/upload/2-2024/images/2024-06-22/255x170/1-495-1719050831-692-width740height495.jpg"
                                        alt="">
                                    <p class="card-title">Product 1</p>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary">Thanh toán</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-4" id="fast-selling-content" style="display: none;">
            bán nhanh
        </div> --}}
    </div>
    @endsection
