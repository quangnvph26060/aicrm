
@extends('Themes.layout_staff.app')
@section('content')
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

                            <div class="col-md-2 mb-4">
                                <div class="product-item1">
                                    <div class="card-body">
                                        <img src="https://icdn.24h.com.vn/upload/2-2024/images/2024-06-22/255x170/1-495-1719050831-692-width740height495.jpg"
                                            alt="">
                                        <p class="card-title">Product 1</p>

                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="decreaseQuantity(this)">-</button>
                                            </div>
                                            <input type="text" class="form-control quantity" value="1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="increaseQuantity(this)">+</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 mb-4">
                                <div class="product-item1">
                                    <div class="card-body">
                                        <img src="https://icdn.24h.com.vn/upload/2-2024/images/2024-06-22/255x170/1-495-1719050831-692-width740height495.jpg"
                                            alt="">
                                        <p class="card-title">Product 1</p>

                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="decreaseQuantity(this)">-</button>
                                            </div>
                                            <input type="text" class="form-control quantity" value="1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="increaseQuantity(this)">+</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-4">
                                <div class="product-item1">
                                    <div class="card-body">
                                        <img src="https://icdn.24h.com.vn/upload/2-2024/images/2024-06-22/255x170/1-495-1719050831-692-width740height495.jpg"
                                            alt="">
                                        <p class="card-title">Product 1</p>

                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="decreaseQuantity(this)">-</button>
                                            </div>
                                            <input type="text" class="form-control quantity" value="1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="increaseQuantity(this)">+</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-4">
                                <div class="product-item1">
                                    <div class="card-body">
                                        <img src="https://icdn.24h.com.vn/upload/2-2024/images/2024-06-22/255x170/1-495-1719050831-692-width740height495.jpg"
                                            alt="">
                                        <p class="card-title">Product 1</p>

                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="decreaseQuantity(this)">-</button>
                                            </div>
                                            <input type="text" class="form-control quantity" value="1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="increaseQuantity(this)">+</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-4">
                                <div class="product-item1">
                                    <div class="card-body">
                                        <img src="https://icdn.24h.com.vn/upload/2-2024/images/2024-06-22/255x170/1-495-1719050831-692-width740height495.jpg"
                                            alt="">
                                        <p class="card-title">Product 1</p>

                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="decreaseQuantity(this)">-</button>
                                            </div>
                                            <input type="text" class="form-control quantity" value="1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="increaseQuantity(this)">+</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-4">
                                <div class="product-item1">
                                    <div class="card-body">
                                        <img src="https://icdn.24h.com.vn/upload/2-2024/images/2024-06-22/255x170/1-495-1719050831-692-width740height495.jpg"
                                            alt="">
                                        <p class="card-title">Product 1</p>

                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="decreaseQuantity(this)">-</button>
                                            </div>
                                            <input type="text" class="form-control quantity" value="1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="increaseQuantity(this)">+</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-4">
                                <div class="product-item1">
                                    <div class="card-body">
                                        <img src="https://icdn.24h.com.vn/upload/2-2024/images/2024-06-22/255x170/1-495-1719050831-692-width740height495.jpg"
                                            alt="">
                                        <p class="card-title">Product 1</p>

                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="decreaseQuantity(this)">-</button>
                                            </div>
                                            <input type="text" class="form-control quantity" value="1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="increaseQuantity(this)">+</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-4">
                                <div class="product-item1">
                                    <div class="card-body">
                                        <img src="https://icdn.24h.com.vn/upload/2-2024/images/2024-06-22/255x170/1-495-1719050831-692-width740height495.jpg"
                                            alt="">
                                        <p class="card-title">Product 1</p>

                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="decreaseQuantity(this)">-</button>
                                            </div>
                                            <input type="text" class="form-control quantity" value="1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="increaseQuantity(this)">+</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-4">
                                <div class="product-item1">
                                    <div class="card-body">
                                        <img src="https://icdn.24h.com.vn/upload/2-2024/images/2024-06-22/255x170/1-495-1719050831-692-width740height495.jpg"
                                            alt="">
                                        <p class="card-title">Product 1</p>

                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="decreaseQuantity(this)">-</button>
                                            </div>
                                            <input type="text" class="form-control quantity" value="1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="increaseQuantity(this)">+</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-4">
                                <div class="product-item1">
                                    <div class="card-body">
                                        <img src="https://icdn.24h.com.vn/upload/2-2024/images/2024-06-22/255x170/1-495-1719050831-692-width740height495.jpg"
                                            alt="">
                                        <p class="card-title">Product 1</p>

                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="decreaseQuantity(this)">-</button>
                                            </div>
                                            <input type="text" class="form-control quantity" value="1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="increaseQuantity(this)">+</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-4">
                                <div class="product-item1">
                                    <div class="card-body">
                                        <img src="https://icdn.24h.com.vn/upload/2-2024/images/2024-06-22/255x170/1-495-1719050831-692-width740height495.jpg"
                                            alt="">
                                        <p class="card-title">Product 1</p>

                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="decreaseQuantity(this)">-</button>
                                            </div>
                                            <input type="text" class="form-control quantity" value="1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary quantity-control"
                                                    type="button" onclick="increaseQuantity(this)">+</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

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

                                <input type="text" class="form-control" id="note"
                                    placeholder="Enter note">
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

            <!-- Right Column: Customer Information and Payment Method -->
            <div class="col-lg-4" id="delivery-selling-content" style="display: none;">
                <div class="card">
                    <div class="card-header">Customer Information</div>
                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                        <!-- Customer information form -->
                        <form action="">
                            <div class="input-group">
                                <i class="fas fa-search"></i>
                                <input type="text" class="form-control" placeholder="Tìm kiếm khách hàng"
                                    name="" id="">
                                <i class="fas fa-plus" data-toggle="modal" data-target="#customerModal"></i>
                            </div>
                        </form>
                        <form>
                            <div class="form-group">
                                <label for="fullName">Full Name</label>
                                <input type="text" class="form-control" id="fullName"
                                    placeholder="Enter full name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="tel" class="form-control" id="phoneNumber"
                                    placeholder="Enter phone number">
                            </div>
                            <div class="form-group">
                                <label for="paymentMethod">Payment Method</label>
                                <select class="form-control" id="paymentMethod">
                                    <option>Credit Card</option>
                                    <option>PayPal</option>
                                    <option>Bank Transfer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="driverNote">Driver's Note</label>
                                <input type="text" class="form-control" id="driverNote"
                                    placeholder="Enter note for driver">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Submit Order</button>
                        </form>
                    </div>
                </div>
            </div>



            <div class="col-lg-4" id="regular-selling-content" style="display: none;">
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
            </div>
        </div>
@endsection       