@extends('Admin.Layout.index')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    header {
        text-align: center;
        padding: 20px 0;
        background-color: #4CAF50;
        color: #fff;
    }

    h1 {
        margin: 0;
    }

    .contact-info {
        display: flex;
        flex-wrap: wrap;
    }

    .contact-item {
        flex: 1 1 300px;
        /* Điều chỉnh độ rộng của mỗi item */
        margin: 10px;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .contact-item h2 {
        margin-top: 0;
    }

    .zalo-link {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .zalo-link:hover {
        background-color: #45a049;
    }
</style>
<header>
    <h1>Trang Hỗ Trợ</h1>
</header>

<div class="container">
    <div class="contact-info">
        <div class="contact-item">
            <h2>Địa chỉ</h2>
            <p>123 Đường ABC, Quận XYZ, Thành phố Hồ Chí Minh</p>
        </div>
        <div class="contact-item">
            <h2>Số điện thoại</h2>
            <p>+84 123 456 789</p>
        </div>
        <div class="contact-item">
            <h2>Email</h2>
            <p>support@example.com</p>
        </div>
        <div class="contact-item">
            <h2>Zalo</h2>
            <p><a href="https://zalo.me/tentkhoan" class="zalo-link">Zalo của tôi</a></p>
        </div>
    </div>



</div>

@endsection
