@extends('Admin.Layout.index')
@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .icon-bell:before {
            content: "\f0f3";
            font-family: FontAwesome;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: #fff;
            margin-bottom: 2rem;
        }

        .card-header {
            background: linear-gradient(135deg, #6f42c1, #007bff);
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
        }

        .breadcrumbs {
            background: #fff;
            padding: 0.75rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .breadcrumbs a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumbs i {
            color: #6c757d;
        }

        .table-responsive {
            margin-top: 1rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table th,
        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .btn {
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .table-hover tbody tr:hover {
            background-color: #e9ecef;
        }

        .dataTables_info,
        .dataTables_paginate {
            margin-top: 1rem;
        }

        .pagination .page-link {
            color: #007bff;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }

        .pagination .page-item:hover .page-link {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .pagination .page-item.active .page-link,
        .pagination .page-item .page-link {
            transition: all 0.3s ease;
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
                    <a href="{{ route('admin.product.store') }}">Sản phẩm</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Sửa</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="text-align: center; color:white">Chỉnh sửa thông tin sản phẩm số {{ $product->id }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{ route('admin.product.update', ['id' => $product->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Tên sản phẩm <span
                                                    class="text text-danger">*</span></label>
                                            <input class="form-control" name="name" type="text"
                                                id="example-text-input" value="{{ $product->name }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Loại thương hiệu<span
                                                    class="text text-danger">*</span></label>
                                            <select class="form-control" name="category_id" id="" required>
                                                <option value="">Chọn thương hiệu</option>
                                                @foreach ($brand as $item)
                                                    <option {{ $product->brands->id == $item->id ? 'selected' : '' }}
                                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-search-input" class="form-label">Giá nhập <span
                                                    class="text text-danger">*</span></label>
                                            <input required class="form-control" name="price" type="number"
                                                id="example-search-input" value="{{ $product->price }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-search-input" class="form-label">Giá bán <span
                                                    class="text text-danger">*</span></label>
                                            <input required class="form-control" name="priceBuy" type="number"
                                                id="example-search-input" value="{{ $product->priceBuy }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="example-url-input" class="form-label">Số lượng <span
                                                    class="text text-danger">*</span></label>
                                            <input required class="form-control" name="quantity" type="number"
                                                id="example-email-input" value="{{ $product->quantity }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Loại Danh Mục<span
                                                    class="text text-danger">*</span></label>
                                            <select class="form-control" name="category_id" id="" required>
                                                <option value="">Chọn danh mục</option>
                                                @foreach ($category as $item)
                                                    <option {{ $product->category_id == $item->id ? 'selected' : '' }}
                                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Trạng thái<span
                                                    class="text text-danger">*</span></label>
                                            <select class="form-control" name="status" id="">
                                                <option value="">Chọn trạng thái</option>
                                                <option {{ $product->status == 'published' ? 'selected' : '' }}
                                                    value="published">Được phát hành</option>
                                                <option {{ $product->status == 'inactive' ? 'selected' : '' }}
                                                    value="inactive">Không hoạt động</option>
                                                <option {{ $product->status == 'scheduled' ? 'selected' : '' }}
                                                    value="scheduled">Lên kế hoạch</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Ảnh sản phẩm <span
                                                    class="text text-danger"></span></label>
                                            <input id="images" class="form-control" type="file" name="images[]"
                                                multiple accept="image/*">
                                            <div style="display: flex">
                                                @foreach ($product->images as $key => $item)
                                                    <div style="position: relative; margin-top: 10px; margin-right: 10px;">
                                                        <img title="{{ $item->image_path }}"
                                                            style="width: 100px; height: 75px;"
                                                            src="{{ asset($item->image_path) }}" alt="">
                                                        <a title="Xóa" href="" class="close-icon">
                                                            <i class="fas fa-minus-square"></i>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="example-url-input" class="form-label">Mô tả <span
                                                    class="text text-danger">*</span></label>
                                            <textarea class="form-control" id="description" name="description" rows="2">{{ $product->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md">Xác nhận</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        function submitForm() {
            document.getElementById('addproduct').submit();
        }
        CKEDITOR.replace('description');
    </script>
@endsection
