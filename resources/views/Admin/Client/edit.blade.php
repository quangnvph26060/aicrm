@extends('Admin.Layout.index')
@section('content')
    <style>
        .add_product>div {
            margin-top: 20px
        }

        h4 {
            text-align: center;
        }
    </style>
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.client.index')}}">Khách hàng</a>
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
                        <h4 class="card-title">Chỉnh sửa thông tin khách hàng số {{$client->id}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                                <form action="{{ route('admin.client.update', ['id' => $client->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label for="name" class="form-label">Tên khách hàng</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $client->name }}" required>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="phone" class="form-label">Số điện thoại</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ $client->phone }}" required>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $client->email }}" required>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="gender" class="form-label">Giới tính</label>
                                            <select class="form-control" id="gender" name="gender" required>
                                                <option value="Male" {{ $client->gender == 'Male' ? 'selected' : '' }}>Nam
                                                </option>
                                                <option value="Female" {{ $client->gender == 'Female' ? 'selected' : '' }}>
                                                    Nữ</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="dob" class="form-label">Ngày sinh</label>
                                            <input type="date" class="form-control" id="dob" name="dob"
                                                value="{{ $client->dob }}" required>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="address" class="form-label">Địa chỉ</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ $client->address }}" required>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="zip_code" class="form-label">Mã bưu điện</label>
                                            <input type="text" class="form-control" id="zip_code" name="zip_code"
                                                value="{{ $client->zip_code }}" required>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary w-md">Xác nhận</button>
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
            document.getElementById('addproduct').submit();
        }
        CKEDITOR.replace('description');
    </script>
@endsection
