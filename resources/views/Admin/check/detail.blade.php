@extends('Admin.Layout.index')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.check.index') }}">Đơn hàng</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-gradient-primary text-white">
                        <h4 class="text-center mb-sm-0 font-size-18">Chi tiết phiếu kiểm số {{ $check->id }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-center text-primary"><b>Thông tin nhân viên</b></h5>
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th scope="row"><i class="fas fa-user"></i>Người tạo</th>
                                            <td>
                                                <div class="nowrap"> <a style="color: black"
                                                        href="{{ route('admin.staff.edit', ['id' => $check->user->id]) }}">{{ $check->user->name }}</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="fas fa-phone"></i> Số điện thoại</th>
                                            <td>
                                                <div class="nowrap">{{ $check->user->phone }}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="fas fa-envelope"></i> Email</th>
                                            <td>
                                                <div class="nowrap">{{ $check->user->email }}</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-center text-primary"><b>Thông tin phiếu kiểm</b></h5>
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th scope="row"><i class="fas fa-receipt"></i> Mã phiếu kiểm</th>
                                            <td>
                                                <div class="nowrap">{{ $check->id }}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="fas fa-box-open"></i> Sản phẩm</th>
                                            <td>
                                                @foreach ($check->checkdetail as $item)
                                                    <div class="d-flex justify-content-between nowrap">
                                                        <span>{{ $item->product->name }}</span>
                                                        <span>
                                                            {{ $item->difference > 0 ? 'thừa' : ($item->difference < 0 ? 'thiếu' : 'đủ') }}
                                                            {{ $item->difference != 0 ? abs($item->difference) : '' }} sản
                                                            phẩm
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('admin.check.index') }}" class="btn btn-primary w-md">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        background: linear-gradient(135deg, #6f42c1, #007bff);
    }

    .card-body {
        padding: 2rem;
        background-color: #f8f9fa;
    }

    .table th,
    .table td {
        vertical-align: middle;
        padding: 1rem;
        font-size: 1rem;
    }

    .table th {
        background-color: #e9ecef;
        font-weight: bold;
        color: #495057;
    }

    .table-hover tbody tr:hover {
        background-color: #dee2e6;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: translateY(-2px);
    }

    .text-primary {
        color: #007bff !important;
    }

    .nowrap {
        white-space: nowrap;
        display: flex;
        justify-content: space-between;
    }
</style>
