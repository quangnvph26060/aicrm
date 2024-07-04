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
                <a href="#">Thương hiệu</a>
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

                            <form action="{{ route('admin.brand.add') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="new-brand-name">Tên:</label>
                                                <input type="text" class="form-control" id="new-brand-name" name="name"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label for="new-brand-name">Logo:</label>
                                                <input type="file" class="form-control" id="new-brand-name"
                                                    name="images" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="new-brand-email">Email:</label>
                                                <input type="email" class="form-control" id="new-brand-email"
                                                    name="email" required>
                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="new-brand-phone">Số điện thoại:</label>
                                                <input type="text" class="form-control" id="new-brand-phone"
                                                    name="phone">
                                            </div>

                                            <div class="form-group">
                                                <label for="new-brand-address">Địa chỉ:</label>
                                                <input type="text" class="form-control" id="new-brand-address"
                                                    name="address">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
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
