<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo tài khoản dùng thử miễn ph</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #620080, #02b4a5);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .register-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 1200px;
            width: 100%;
            display: flex;
            flex-direction: row;
        }

        .register-left {
            position: relative;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 50px 20px;
            background: rgba(0, 0, 0, 0.4);
        }

        .register-left {
            background: url('https://it.mobifone.vn/wp-content/uploads/cac-mo-hinh-quan-ly-ban-hang-thuong-se-bao-gom-quan-ly-nhan-vien-tai-chinh-700x408.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 50px 20px;
            flex: 1;
            background-size: cover;
            background-repeat: no-repeat;
            F display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-left h1 {
            font-size: 32px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .register-left p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .register-right {
            padding: 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 450px;
            /* Adjusted max-width */
            margin-right: 20px;
            /* Added margin for separation */
        }

        .register-right h4 {
            font-size: 24px;
            margin-bottom: 30px;
            font-weight: 500;
            color: #0062E6;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
        }

        .form-select {
            border-radius: 8px;
            padding: 10px 15px;
        }

        .btn-success {
            background: #0062E6;
            border: none;
            padding: 15px;
            font-size: 16px;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .btn-success:hover {
            background: #004bb5;
        }
    </style>
</head>

<body>

    <div class="register-container">
        <div class="register-left">
            {{-- <h1>Quản lý dễ dàng</h1>
            <p>Bán hàng đơn giản</p>
            <p>Hỗ trợ đăng ký 1800 6162</p>
            <p>Đăng ký tài khoản dùng thử ngay để trải nghiệm những tính năng tuyệt vời của chúng tôi.</p>
            <p>Liên hệ với chúng tôi để được hỗ trợ tốt nhất.</p> --}}
        </div>
        <div class="register-right">
            <h4 style="text-align: center;">Tạo tài khoản dùng thử miễn phí</h4>
            <form action="{{ route('register.signup') }}" method="POST" id="registerForm">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nhập họ và tên">
                            <div class="invalid-feedback d-block" style="font-weight: 500;" id="name_error"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Tên công ty</label>
                            <input type="text" class="form-control" id="company_name" name="company_name"
                                placeholder="Nhập tên công ty">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="Nhập số điện thoại" value="{{ old('phone') }}">
                            <div class="invalid-feedback d-block" style="font-weight: 500;" id="phone_error"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Nhập địa chỉ email" value="{{ old('email') }}">
                            <div class="invalid-feedback d-block" style="font-weight: 500;" id="email_error"></div>
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
                            <p id="store_domain"></p>
                            <div class="invalid-feedback d-block" style="font-weight: 500;" id="store_name_error"></div>

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
                            <div class="invalid-feedback d-block" style="font-weight: 500;" id="city_error"></div>
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
                            <div class="invalid-feedback d-block" style="font-weight: 500;" id="field_error"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Nhập địa chỉ">
                            <div class="invalid-feedback d-block" style="font-weight: 500;" id="address_error"></div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="store_domain" class="form-label">Tên miền</label>
                            <input type="text" class="form-control" id="store_domain" name="store_domain"
                                placeholder="Tên miền của bạn" readonly>
                        </div>
                    </div>
                </div> --}}
                <div class="text-center mt-4">
                    <button onclick="submitRegisterForm(event)" type="button" class="btn btn-success w-100">Đăng
                        ký</button>
                    <a href="{{ route('formlogin') }}">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('/validator/validator.js') }}"></script>
    <script>
        function updateDomain() {
            var storeNameInput = document.getElementById('store_name');
            var storeDomainInput = document.getElementById('store_domain');

            var storeName = storeNameInput.value.trim();
            var domainSuffix = '.aicrm.vn'; // Thay đổi tên miền của bạn tại đây

            if (storeName !== '') {
                // Loại bỏ dấu và chuyển thành chữ thường
                var storeDomain = storeName.toLowerCase()
                    .normalize('NFD').replace(/[\u0300-\u036f]/g, "")
                    .replace(/\s+/g, '') + domainSuffix;
                // storeDomainInput.value = storeDomain;
                storeDomainInput.textContent = storeDomain;
            } else {
                // storeDomainInput.value = '';
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


        function submitRegisterForm(event) {
            event.preventDefault();

            if (validateAllFields(formRegister)) {
                document.getElementById('registerForm').submit();
            }
        }
    </script>

</body>

</html>
