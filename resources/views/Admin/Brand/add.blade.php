@extends('Admin.Layout.index')

@section('content')
<style>
    .add_product>div {
        margin-top: 20px !important;
    }

    .card {
        border-radius: 10px !important;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1) !important;
    }

    .card-header {
        background-color: #007bff !important;
        color: #fff !important;
        border-bottom: none !important;
        border-top-left-radius: 10px !important;
        border-top-right-radius: 10px !important;
    }

    .card-title {
        margin-bottom: 0 !important;
    }

    .card-body {
        padding: 20px !important;
    }

    .form-control {
        border-radius: 8px !important;
        padding: 12px !important;
        box-shadow: none !important;
    }

    .form-control:focus {
        border-color: #007bff !important;
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25) !important;
    }

    .btn-primary {
        background-color: #007bff !important;
        border-color: #007bff !important;
        border-radius: 8px !important;
        padding: 12px 20px !important;
        transition: background-color 0.3s ease !important;
    }

    .btn-primary:hover {
        background-color: #0056b3 !important;
        border-color: #0056b3 !important;
    }
</style>

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
                <a href="{{route('admin.brand.store')}}">Thương hiệu</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Thêm</a>
            </li>
        </ul>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="text-align: center; color:#fff">Thêm thương hiệu mới</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.brand.add') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new-brand-name">Tên:</label>
                                    <input type="text" class="form-control" id="new-brand-name" name="name" required>
                                </div>

                                <div class="form-group">
                                    <label for="new-brand-logo">Logo:</label>
                                    <input type="file" class="form-control" id="new-brand-logo" name="images" required>
                                </div>

                                <div class="form-group">
                                    <label for="new-brand-email">Email:</label>
                                    <input type="email" class="form-control" id="new-brand-email" name="email" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new-brand-phone">Số điện thoại:</label>
                                    <input type="text" class="form-control" id="new-brand-phone" name="phone">
                                </div>

                                <div class="form-group">
                                    <label for="new-brand-address">Địa chỉ:</label>
                                    <input type="text" class="form-control" id="new-brand-address" name="address">
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
