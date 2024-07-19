@extends('admin.layout.index')
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
            text-align: center;
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

        .form-label {
            font-weight: 500;
        }

        .form-control,
        .form-select {
            border-radius: 5px;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .add_product>div {
            margin-top: 20px;
        }

        .modal-footer {
            justify-content: center;
            border-top: none;
        }

        textarea.form-control {
            height: auto;
        }

        #description {
            border-radius: 5px;
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
                    <a href="{{ route('admin.category.index') }}">Danh mục</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Thêm</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title" style="text-align: center; color:white">Danh sách danh mục</h4>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <form action="{{ route('admin.category.store') }}" method="POST" id="addcategory"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label form-label">Tên danh mục:</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                        <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                style="font-weight: 500" id="name_error"></span> </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="col-form-label form-label">Mô tả:</label>
                                        <textarea required class="form-control" name="description" id="description" rows="4"></textarea>
                                        <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                style="font-weight: 500" id="description_error"></span> </div>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <button type="button" onclick="addcategory(event)"
                                            class="btn btn-primary">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> --}}
    <script>
        function submitForm() {
            document.getElementById('addcategory').submit();
        }
        CKEDITOR.replace('description');
        var validateorder = {
            'name': {
                'element': document.getElementById('name'),
                'error': document.getElementById('name_error'),
                'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E015')
                }, ]
            },
            'description': {
                'element': document.getElementById('description'),
                'error': document.getElementById('description_error'),
                'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E016')
                }, ]
            },

        }

        function addcategory(event) {
            event.preventDefault();
            if (validateAllFields(validateorder)) {
                submitForm();
            }
        }
    </script>
@endsection
