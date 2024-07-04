@extends('Admin.Layout.index')
@section('content')
<style>
    .add_product>div{
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
                <a href="#">Danh mục</a>
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
                    <h4 class="card-title">Basic</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                            <form action="{{ route('admin.brand.update', ['id' => $brand->id]) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="brand-name">Name:</label>
                                        <input type="text" class="form-control" id="brand-name" name="name" value="{{ $brand->name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="brand-name">Logo:</label>
                                        <input type="file" class="form-control" id="brand-logo" name="images">
                                        <div style="margin-top: 20px">
                                            <img style="width: 100px; height: 70px;" src="{{ asset($brand->logo) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="brand-email">Email:</label>
                                        <input type="email" class="form-control" id="brand-email" name="email" value="{{ $brand->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="brand-phone">Phone:</label>
                                        <input type="text" class="form-control" id="brand-phone" name="phone" value="{{ $brand->phone }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="brand-address">Address:</label>
                                        <input type="text" class="form-control" id="brand-address" name="address" value="{{ $brand->address }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="save-brand-details">Lưu</button>
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
