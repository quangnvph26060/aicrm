@extends('Themes.layouts.app')

@section('content')
    <div class="container mt-5" style="padding-top: 60px;">
        <div class="table-responsive table-card mt-4 mb-4">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-center">
                        <h4 class="mb-sm-0 font-size-18">Chi tiết hóa đơn số {{ $order->id }}</h4>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Mã đơn hàng</th>
                                        <td>{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tên khách hàng</th>
                                        <td>{{ $order->client->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tên nhân viên</th>
                                        <td>{{ $order->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Sản phẩm</th>
                                        <td>
                                            @foreach ($order->orderDetails as $item)
                                                {{ $item->product->name }} x{{ $item->quantity }}<br>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tổng tiền</th>
                                        <td>{{ number_format($order->total_money) }} VND</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Địa chỉ nhận</th>
                                        <td>{{ $order->receive_address }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mã bưu điện</th>
                                        <td>{{ $order->client->zip_code }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-center mt-4">
                                <a href="{{ route('admin.order.index') }}" class="btn btn-primary w-md">Quay lại</a>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

    <style>
        .page-title-box {
            margin-bottom: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card-body {
            padding: 2rem;
        }

        .table-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
@endsection
