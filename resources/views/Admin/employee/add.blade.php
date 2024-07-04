@extends('Admin.Layout.index')
@section('content')
<style>
    .add_product>div {
        margin-top: 20px
    }
</style>
<div class="page-inner">
    <div class="page-header">
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Nhân viên</a>
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
                    <h4 class="card-title">Basic</h4>
                </div>
                <div class="card-body">
                    <div class="">
                        <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <form action="{{ route('admin.staff.add') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="new-user-name">Tên:</label>
                                                <input type="text" class="form-control" id="new-user-name" name="name"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="new-user-email">Email:</label>
                                                <input type="email" class="form-control" id="new-user-email"
                                                    name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="new-user-phone">Số điện thoại:</label>
                                                <input type="text" class="form-control" id="new-user-phone"
                                                    name="phone">
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="new-user-address">Địa chỉ:</label>
                                                <input type="text" class="form-control" id="new-user-address"
                                                    name="address">
                                            </div>
                                            <div class="form-group">
                                                <label for="new-user-password">Mật khẩu:</label>
                                                <input type="password" class="form-control" id="new-user-password"
                                                    name="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="new-user-password-confirm">Xác nhận mật khẩu:</label>
                                                <input type="password" class="form-control"
                                                    id="new-user-password-confirm" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin: 20px">
                                    <button style="text-align: center;" type="submit" class="btn btn-primary">Thêm nhân viên</button>
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