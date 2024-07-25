@extends('admin.layout.index')

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
        background-color: #2f0ee9;
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
            <p><a class="btn btn-primary" href="https://zalo.me/tentkhoan" class="zalo-link">Zalo của tôi</a></p>
        </div>
    </div>
    <div style="margin: 10px 10px;">
        <form action="{{ route('admin.support.feedback') }}" method="post">
            @csrf
            <div class="message">
                <h2>Góp ý</h2>
                <textarea style="width: 100%; padding: 10px 20px; " name="message" id="message" rows="5"></textarea>
            </div>
            <input class="btn btn-primary" style="padding: 5px 20px; margin-top: 10px" type="submit" value="Gửi">
        </form>
    </div>


</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"></script>
    @if (session('success'))
        <script>
            $(document).ready(function() {
                $.notify({
                    icon: 'icon-bell',
                    title: 'Đánh giá',
                    message: '{{ session('success') }}',
                }, {
                    type: 'secondary',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    time: 1000,
                });
            });
            </script>
    @endif

@endsection
