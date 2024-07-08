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
            text-align: center !important;
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

        img.brand-logo {
            width: 100px !important;
            height: 70px !important;
            margin-top: 10px !important;
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
                    <a href="{{ route('admin.brand.store') }}">Thương hiệu</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Sửa</a>
                </li>
            </ul>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="color:white">Chỉnh sửa thương hiệu số {{ $brand->id }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.brand.update', ['id' => $brand->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="brand-name">Tên:</label>
                                        <input type="text" class="form-control" id="brand-name" name="name"
                                            value="{{ $brand->name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="brand-logo">Logo:</label>
                                        <input type="file" class="form-control" id="brand-logo" name="images">
                                        <img src="{{ asset($brand->logo) }}" alt="Brand Logo" class="brand-logo">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="brand-email">Email:</label>
                                        <input type="email" class="form-control" id="brand-email" name="email"
                                            value="{{ $brand->email }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="brand-phone">Số điện thoại:</label>
                                        <input type="text" class="form-control" id="brand-phone" name="phone"
                                            value="{{ $brand->phone }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="brand-address">Địa chỉ:</label>
                                        <input type="text" class="form-control" id="brand-address" name="address"
                                            value="{{ $brand->address }}">
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="save-brand-details">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
 style="color:white"
