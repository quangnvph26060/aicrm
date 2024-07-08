@extends('Admin.Layout.index')
@section('content')
    <style>
        .add_product>div {
            margin-top: 20px;
        }

        h4 {
            text-align: center;
            color: white !important;
        }

        .card-header {
            background: linear-gradient(90deg, #007bff, #33b5e5);
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: linear-gradient(90deg, #007bff, #0056b3);
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .form-control {
            border-radius: 0.375rem;
            box-shadow: none;
            transition: box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            border-color: #007bff;
        }

        .breadcrumbs {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .breadcrumbs a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumbs a:hover {
            color: #0056b3;
        }

        .form-label {
            font-weight: bold;
        }

        .mb-12 {
            margin-bottom: 1.5rem !important;
        }

        .card-body {
            background: #f8f9fa;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            padding: 20px;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .page-inner {
            margin-top: 20px;
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
                    <a href="{{route('admin.category.index')}}">Danh mục</a>
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
                        <h4 class="card-title">Chỉnh sửa danh mục số {{ $category->id }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <form action="{{ route('admin.category.update', ['id' => $category->id]) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-12">
                                                <label for="example-text-input" class="form-label">Danh Mục</label>
                                                <input required class="form-control" name="name" value="{{ $category->name }}" type="text" id="example-text-input">
                                            </div>
                                            <div class="mb-12">
                                                <label for="example-text-input" class="form-label">Mô tả</label>
                                                <textarea required class="form-control" name="description" id="description" rows="4">{!! $category->description !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div style="margin: 20px; text-align: center">
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
    </div>

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
