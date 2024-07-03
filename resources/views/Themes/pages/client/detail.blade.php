@extends('Themes.layouts.app')

@section('content')
<div class="container mt-5" style="padding-top: 60px;">
    <div class="table-responsive table-card mt-4 mb-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="page-title-box d-sm-flex align-items-center justify-content-center">
                    <h4 class="mb-sm-0 font-size-18">Chỉnh sửa thông tin khách hàng</h4>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.client.update', ['id' => $client->id]) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="name" class="form-label">Tên khách hàng</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}" required>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $client->phone }}" required>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $client->email }}" required>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="gender" class="form-label">Giới tính</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="Male" {{ $client->gender == 'Male' ? 'selected' : '' }}>Nam</option>
                                        <option value="Female" {{ $client->gender == 'Female' ? 'selected' : '' }}>Nữ</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="dob" class="form-label">Ngày sinh</label>
                                    <input type="date" class="form-control" id="dob" name="dob" value="{{ $client->dob }}" required>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $client->address }}" required>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="zip_code" class="form-label">Mã bưu điện</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $client->zip_code }}" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-md">Xác nhận</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

<style>
    .alert {
        margin-top: 20px;
    }
    .form-label {
        font-weight: bold;
    }
    .page-title-box {
        margin-bottom: 20px; /* Adjust this value as needed for spacing */
    }
</style>

<script>
    var modal = document.getElementById("myModal");
    var openModal = document.getElementById("openModal");

    openModal.onclick = function() {
        modal.style.display = "block";
    }

    var closeModal = document.querySelector("#myModal .btn-close");

    closeModal.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    var modalProduct = document.getElementById("myModalProduct");
    var openModalProduct = document.getElementById("openModalProduct");

    openModalProduct.onclick = function() {
        modalProduct.style.display = "block";
    }

    var closeModalProduct = document.querySelector("#myModalProduct .btn-close");

    closeModalProduct.onclick = function() {
        modalProduct.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modalProduct) {
            modalProduct.style.display = "none";
        }
    }
</script>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');

    function submitForm() {
        document.getElementById('addproduct').submit();
    }
</script>
@endsection
