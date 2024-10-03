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
                    <a href="{{ route('admin.company.index') }}">Nhà cung cấp</a>
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
                        <h4 class="card-title" style="text-align: center;color:white">Thông tin nhà cung cấp số
                            {{ $companies->id }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                                <form id="editclient" action="{{ route('admin.company.update', ['id' => $companies->id]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label for="name" class="form-label">Tên nhà cung cấp</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $companies->name }}" required>
                                            <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                    style="font-weight: 500" id="name_error"></span> </div>

                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="phone" class="form-label">Số điện thoại</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ $companies->phone }}" required>
                                            <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                    style="font-weight: 500" id="phone_error"></span> </div>

                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="phone" class="form-label">Số tài khoản</label>
                                            <input type="text" class="form-control" id="bank_account" name="bank_account"
                                                value="{{ $companies->bank_account }}" required>
                                            <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                    style="font-weight: 500" id="bank_error"></span> </div>

                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $companies->email }}" required>
                                            <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                    style="font-weight: 500" id="email_error"></span> </div>

                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="tax_number" class="form-label">Mã số thuế</label>
                                            <input type="email" class="form-control" id="tax_number" name="tax_number"
                                                value="{{ $companies->tax_number }}" required>
                                            <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                    style="font-weight: 500" id="tax_number_error"></span> </div>

                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="bank_name" class="form-label">Ngân hàng</label>
                                            <select name="bank_id" id="bank_id" class="form-control">
                                                <option value="">-------- Chọn ngân hàng --------</option>
                                                @foreach ($bank as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($companies->bank_id == $item->id) selected @endif>
                                                        {{ $item->shortName . ' - ' . $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="city_name" class="form-label">Khu vực</label>
                                            <select name="city_id" id="city_id" class="form-control">
                                                <option value="">-------- Chọn khu vực --------</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        @if ($companies->city_id == $city->id) selected @endif>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="form-label">Địa chỉ</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ $companies->address }}" required>
                                            <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                    style="font-weight: 500" id="address_error"></span> </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="note" class="form-label">Ghi chú</label>
                                            <textarea class="form-control" id="note" name="note" required>{{ $companies->note }}</textarea>
                                            <div class="col-lg-9">
                                                <span class="invalid-feedback d-block" style="font-weight: 500"
                                                    id="note_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" onclick="editclient(event)"
                                            class="btn btn-primary w-md">Xác
                                            nhận</button>
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
        function submitForm() {
            document.getElementById('editclient').submit();
        }
        var validateorder = {
            'name': {
                'element': document.getElementById('name'),
                'error': document.getElementById('name_error'),
                'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E037')
                }, ]
            },
            'email': {
                'element': document.getElementById('email'),
                'error': document.getElementById('email_error'),
                'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E038')
                }, ]
            },

            'phone': {
                'element': document.getElementById('phone'),
                'error': document.getElementById('phone_error'),
                'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E039')
                }, ]
            },

            'address': {
                'element': document.getElementById('address'),
                'error': document.getElementById('address_error'),
                'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E040')
                }, ]
            },

        }

        function editclient(event) {
            event.preventDefault();
            if (validateAllFields(validateorder)) {
                submitForm();
            }
        }
    </script>
@endsection
