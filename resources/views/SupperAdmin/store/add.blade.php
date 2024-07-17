@extends('SupperAdmin.layout.index')
@section('content')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <a href="">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('super.store.index') }}">Khách hàng</a>
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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="text-align: center; color:white">Thêm sản phẩm</h4>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <form action="{{ route('super.store.store') }}" method="POST" id="registerForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Họ và tên</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Nhập họ và tên">
                                                <div class="invalid-feedback d-block" style="font-weight: 500;"
                                                    id="name_error"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="company_name" class="form-label">Tên công ty</label>
                                                <input type="text" class="form-control" id="company_name"
                                                    name="company_name" placeholder="Nhập tên công ty">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Số điện thoại</label>
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    placeholder="Nhập số điện thoại" value="{{ old('phone') }}">
                                                <div class="invalid-feedback d-block" style="font-weight: 500;"
                                                    id="phone_error"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Nhập địa chỉ email" value="{{ old('email') }}">
                                                <div class="invalid-feedback d-block" style="font-weight: 500;"
                                                    id="email_error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="tax_code" class="form-label">Mã số thuế</label>
                                                <input type="text" class="form-control" id="tax_code" name="tax_code"
                                                    placeholder="Nhập mã số thuế">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="store_name" class="form-label">Tên cửa hàng</label>
                                                <input type="text" class="form-control" id="store_name" name="store_name"
                                                    placeholder="Nhập tên cửa hàng" oninput="updateDomain()">
                                                <p id="store_domain1"></p>
                                                <div class="invalid-feedback d-block" style="font-weight: 500;"
                                                    id="store_name_error"></div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="city" class="form-label">Khu vực</label>
                                                <select class="form-select" id="city" name="city">
                                                    <option value="">Chọn thành phố</option>
                                                    @foreach ($city as $cities)
                                                        <option value="{{ $cities->id }}">{{ $cities->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback d-block" style="font-weight: 500;"
                                                    id="city_error"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="field_id" class="form-label">Lĩnh vực hoạt động</label>
                                                <select class="form-select" id="field" name="field">
                                                    <option value="">Chọn lĩnh vực</option>
                                                    @foreach ($field as $fields)
                                                        <option value="{{ $fields->id }}">{{ $fields->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback d-block" style="font-weight: 500;"
                                                    id="field_error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Địa chỉ</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    placeholder="Nhập địa chỉ">
                                                <div class="invalid-feedback d-block" style="font-weight: 500;"
                                                    id="address_error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="display: none">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="store_domain" class="form-label">Tên miền</label>
                                                <input type="text" class="form-control" id="store_domain"
                                                    name="store_domain" placeholder="Tên miền của bạn" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer m-2">
                                        <button type="button" onclick="submitAddForm(event)"
                                            class="btn btn-primary w-md">
                                            Xác nhận
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('/validator/validator.js') }}"></script>
    <script>
        function updateDomain() {
            var storeNameInput = document.getElementById('store_name');
            var storeDomainInput1 = document.getElementById('store_domain1');
            var storeDomainInput = document.getElementById('store_domain');
            var storeName = storeNameInput.value.trim();
            var domainSuffix = '.aicrm.vn'; // Thay đổi tên miền của bạn tại đây

            if (storeName !== '') {
                // Loại bỏ dấu và chuyển thành chữ thường
                var storeDomain = storeName.toLowerCase()
                    .normalize('NFD').replace(/[\u0300-\u036f]/g, "")
                    .replace(/\s+/g, '') + domainSuffix;
                storeDomainInput.value = storeDomain;
                storeDomainInput1.textContent = storeDomain;
            } else {
                storeDomainInput.value = '';
                storeDomainInput.textContent = '';
            }
        }

        var formRegister = {
            'name': {
                'element': document.getElementById('name'),
                'error': document.getElementById('name_error'),
                'validations': [{
                        'func': function(value) {
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('R042')
                    }
                    // Add other validations as needed
                ]
            },
            'phone': {
                'element': document.getElementById('phone'),
                'error': document.getElementById('phone_error'),
                'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('R043')
                }]
            },
            'email': {
                'element': document.getElementById('email'),
                'error': document.getElementById('email_error'),
                'validations': [{
                        'func': function(value) {
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('R046')
                    },
                    {
                        'func': function(value) {
                            return checkEmail(value);
                        },
                        'message': generateErrorMessage('R047')
                    }
                ]
            },
            'store_name': {
                'element': document.getElementById('store_name'),
                'error': document.getElementById('store_name_error'),
                'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('R048')
                }]
            },
            'city': {
                'element': document.getElementById('city'),
                'error': document.getElementById('city_error'),
                'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('R049')
                }]
            },
            'field': {
                'element': document.getElementById('field'),
                'error': document.getElementById('field_error'),
                'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('R050')
                }]
            },
            'address': {
                'element': document.getElementById('address'),
                'error': document.getElementById('address_error'),
                'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('R051')
                }]
            }
        };


        function submitAddForm(event) {
            event.preventDefault();

            if (validateAllFields(formRegister)) {
                document.getElementById('registerForm').submit();
            }
        }

        $(document).ready(function() {
            @if (session('modal'))
                $('#successModal').modal('show');
            @endif
        });
    </script>
@endsection
