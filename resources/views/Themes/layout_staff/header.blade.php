<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout Staff</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Notify Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <!-- Bootstrap CSS for better styling (optional) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/staff.css')}}">
    <script src="{{ asset('validator/validator.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
    /* Container của submenu */
    .submenu {
        display: none;
        /* Ẩn submenu khi không được hover */
        position: absolute;
        right: 10px;
        top: 50px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        z-index: 1000;
    }

    /* Thiết lập cho các mục trong submenu */
    .submenu ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    /* Thiết lập cho các liên kết trong submenu */
    .submenu ul li {
        padding: 12px 16px;
        text-align: left;
    }

    .submenu ul li a {
        text-decoration: none;
        color: #333;
        display: block;
    }

    /* Hiệu ứng hover cho các mục trong submenu */
    .submenu ul li:hover {
        background-color: #f0f0f0;
    }

    /* Hiệu ứng hover cho biểu tượng home */
    .home-icon:hover+.submenu,
    .submenu:hover {
        display: block;
    }

    /* Định dạng cho biểu tượng home */
    .home-icon {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    /* Định dạng cho biểu tượng người dùng */
    .home-icon i {
        color: #333;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const homeIcon = document.getElementById('homeIcon');
    const submenu = document.getElementById('submenu');

    homeIcon.addEventListener('click', function(event) {
        event.preventDefault();
        submenu.style.display = (submenu.style.display === 'none' || submenu.style.display === '') ? 'block' : 'none';
    });

    // Đóng menu con khi nhấp ra ngoài
    document.addEventListener('click', function(event) {
        if (!homeIcon.contains(event.target) && !submenu.contains(event.target)) {
            submenu.style.display = 'none';
        }
    });

});

</script>


<!-- Bao gồm thư viện SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Bao gồm thư viện SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

@if (session('action'))
<script>

    $(document).ready(function(){
        Swal.fire({
        icon: 'success',
        title: 'Thông báo',
        text: '{{ session('action') }}',
        position: 'center',
        showConfirmButton: false, // Ẩn nút xác nhận
        timer: 3000 // Tự động đóng sau 3 giây
      });
    })
</script>

@else
@if (session('fail'))
<script>
    $(document).ready(function(){
            Swal.fire({
            icon: 'error',
            title: 'Thông báo',
            text: '{{ session('fail') }}',
            position: 'center',
            showConfirmButton: false, // Ẩn nút xác nhận
            timer: 3000 // Tự động đóng sau 3 giây
        });
        })
</script>

@endif
@endif

<body style="overflow-x: hidden; padding-top: 0px">
    {{-- <header class="header">
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
    </header> --}}

    <header class="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Left side: Search bar -->
                <div class="col-lg-8">
                    {{-- <form class="form-inline my-2 my-lg-0 search-bar">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search products..."
                            aria-label="Search">
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><i
                                class="fas fa-search"></i></button>
                    </form> --}}
                    <a href="{{ route('staff.index') }}">
                        <img style="width: 50px; height: auto;" src="https://png.pngtree.com/template/20191219/ourmid/pngtree-happy-shop-logo-designs-fun-store-logo-template-vector-illustration-image_341573.jpg" alt="">
                    </a>
                </div>
                <!-- Right side: Icons -->
                <div class="col-lg-4 text-right">
                    <a href="#" class="home-icon" id="homeIcon" style="font-size: 20px;">
                        <i style="color: white;" class="fas fa-user-tag"></i>
                    </a>
                    <div id="submenu" class="submenu">
                        <ul>
                            {{-- <li><a href="#">Thông tin tài khoản</a></li> --}}
                            <li><a style="padding: 0px" class="dropdown-item" href="{{ route('staff.order') }}">Lịch sử mua hàng</a></li>
                            <li> <form id="logoutForm" action="{{ route('admin.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <a style="padding: 0px" class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                Đăng xuất
                            </a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </header>
