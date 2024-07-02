<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Interface</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style scoped>
        .item {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 20px;
        }

        .item-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 5px;
        }

        .product-item1 img {
            max-width: 100%;
            height: auto;
        }

        .item-name {
            text-align: center;
        }

        .main_note input {
            border-right: none;
            border-left: none;
            border-top: none;
            border-bottom: none;
        }

        /* Custom styles for header */
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 0;
        }

        .header .search-bar {
            max-width: 400px;
        }

        .header .cart-icon,
        .header .home-icon {
            color: #ffffff;
            margin-left: 10px;
        }

        .product-item1 {
            transition: box-shadow 0.3s, border-color 0.3s;
            box-shadow: 0 0 5px rgba(48, 84, 243, 0.5);
        }

        .main_note {
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(48, 84, 243, 0.5);
        }

        .product-item1:hover {
            border: 1px solid #007bff;
            box-shadow: 0 0 5px rgba(47, 34, 230, 0.5);
            border-radius: 10px;
        }

        .product-item .quantity {
            width: 70px;
            text-align: center;
        }

        .quantity-control {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }

        li:hover {
            cursor: pointer;
            background-color: #f2f2f2;
        }

        body {

            background-color: rgba(0, 0, 0, .03);

        }

        .input-group {
            position: relative;
        }

        .input-group .fa-search {
            position: absolute;
            left: 10px;
            top: 10px;
            color: #888;
        }

        .form-control {
            padding-left: 30px;
        }

        .input-group .fa-plus {
            position: absolute;
            right: 10px;
            top: 10px;
            color: #007bff;
            cursor: pointer;
        }

        #fullName,
        #email,
        #phoneNumber,
        #paymentMethod,
        #driverNote {
            border-right: none;
            border-left: none;
            border-top: none;
        }

        .input-group {
            position: relative;
        }

        .input-group .fa-search {
            position: absolute;
            left: 10px;
            top: 10px;
            color: #888;
        }

        .form-control {
            padding-left: 30px;
        }

        .input-group .fa-plus {
            position: absolute;
            right: 10px;
            top: 10px;
            color: #007bff;
            cursor: pointer;
        }

        .user-image {
            text-align: center;
            margin-top: 20px;
        }

        .user-image img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Left side: Search bar -->
                <div class="col-lg-8">
                    <form class="form-inline my-2 my-lg-0 search-bar">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search products..."
                            aria-label="Search">
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><i
                                class="fas fa-search"></i></button>
                    </form>
                </div>
                <!-- Right side: Icons -->
                <div class="col-lg-4 text-right">
                    <a href="#" class="cart-icon"><i class="fas fa-shopping-cart fa-lg"></i></a>
                    <a href="#" class="home-icon"><i class="fas fa-home fa-lg"></i></a>
                </div>
            </div>
        </div>
    </header>

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
        <div class="row mt-4">
            <div class="col-lg-6">
                <ul class="d-flex justify-content-between">
                    <li class="d-flex justify-content-between align-items-center" id="fast-selling">
                        <i class="fas fa-bolt"></i> Bán nhanh
                    </li>
                    <li class="d-flex justify-content-between align-items-center" id="regular-selling">
                        <i class="fas fa-shopping-bag"></i> Bán thường
                    </li>
                    <li class="d-flex justify-content-between align-items-center" id="delivery-selling">
                        <i class="fas fa-truck"></i> Bán giao hàng
                    </li>

                </ul>
            </div>
            <div class="col-lg-6">
                <li class="d-flex justify-content-end align-items-center" id="phone-number">
                    <i class="fas fa-phone"></i> Số điện thoại: 1234567890
                </li>
            </div>
        </div>
    </div>
    <!-- Right side: Footer -->
    <!-- Modal -->
    <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerModalLabel">Customer Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form>
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" class="form-control" id="fullName"
                                        placeholder="Enter full name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="Enter email">
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
                        <div class="col-lg-6 user-image">
                            <img src="https://via.placeholder.com/150" alt="User Image">
                            <!-- Replace the src value with the actual image URL -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- JavaScript code -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("regular-selling").click();
        });

        // Function to show the corresponding content when a footer item is clicked
        function showFooterContent(id) {
            // Hide all footer content
            var footerContent = document.querySelectorAll("#row > .col-lg-4");
            for (var i = 0; i < footerContent.length; i++) {
                footerContent[i].style.display = "none";
            }
           
            // Show the selected footer content
            var selectedContent = document.getElementById(id + "-content");
            if (selectedContent) {
                selectedContent.style.display = "block";
            }
           
            var selectedContent = document.getElementById(id + "-content1");
            if (selectedContent) {
                selectedContent.style.display = "block";
            }
        }

        // Event listeners for footer items
        document.getElementById("fast-selling").addEventListener("click", function() {
            showFooterContent("fast-selling");
        });

        document.getElementById("regular-selling").addEventListener("click", function() {
            showFooterContent("regular-selling");
            document.getElementById('regular-selling-content1').style.display = 'block';
            document.getElementById('delivery-selling-content1').style.display = 'none';
        });

        document.getElementById("delivery-selling").addEventListener("click", function() {
            showFooterContent("delivery-selling");
            document.getElementById('delivery-selling-content1').style.display = 'block';
        });

        function increaseQuantity(button) {
            var input = button.parentNode.parentNode.querySelector(".quantity");
            var currentValue = parseInt(input.value);
            input.value = currentValue + 1;
        }

        function decreaseQuantity(button) {
            var input = button.parentNode.parentNode.querySelector(".quantity");
            var currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }
    </script>
</body>

</html>
