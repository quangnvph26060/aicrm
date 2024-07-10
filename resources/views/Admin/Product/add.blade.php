@extends('Admin.Layout.index')
@section('content')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
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

    .form-control, .form-select {
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
                <a href="{{route('admin.dashboard')}}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.product.store')}}">Sản phẩm</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Thêm</a> d
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"  style="text-align: center; color:white">Thêm sản phẩm mới</h4>
                </div>
                <div class="card-body">
                    <div class="">
                        <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <form action="{{ route('admin.product.add') }}" method="POST" enctype="multipart/form-data" id="addproduct">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 add_product">
                                        <div>
                                            <label for="placeholderInput" class="form-label">Tên sản phẩm</label>
                                            <input type="text" class="form-control" name="name" id="name">
                                            <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500"
                                                id="name_error"></span> </div>
                                        </div>
                                        <div>
                                            <label for="placeholderInput" class="form-label">Thương hiệu</label>
                                            <select class="form-control" name="brand_id" id="brand_id" required>
                                                <option value="">Chọn danh mục</option>
                                                @foreach ($brand as $item )
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500"
                                                id="brand_error"></span> </div>
                                        </div>
                                        <div>
                                            <label for="example-text-input" class="form-label">Loại Danh Mục<span class="text text-danger">*</span></label>
                                            <select class="form-control" name="category_id" id="category_id" required>
                                                <option value="">Chọn danh mục</option>
                                                @foreach ($category as $item )
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="category_id_error"></span></div>
                                        </div>
                                        <div>
                                            <label for="placeholderInput" class="form-label">Tồn kho</label>
                                            <input value="" min='1' required class="form-control" name="quantity" type="number" id="quantity">
                                            <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500"
                                                id="quantity_error"></span> </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 add_product">
                                        <div>
                                            <label for="example-search-input" class="form-label">Giá nhập<span class="text text-danger">*</span></label>
                                            <input value="" min='1' required class="form-control" name="price" type="number" id="price">
                                            <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500"
                                                id="price_error"></span> </div>
                                        </div>
                                        <div>
                                            <label for="example-search-input" class="form-label">Giá bán<span class="text text-danger">*</span></label>
                                            <input value="" min='1' required class="form-control" name="priceBuy" type="number" id="priceBuy">
                                            <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500"
                                                id="priceBuy_error"></span> </div>
                                        </div>
                                        <div>
                                            <label for="example-text-input" class="form-label">Ảnh sản phẩm<span class="text text-danger">*</span></label>
                                            <input id="images" class="form-control" type="file" name="images[]" multiple accept="image/*" >
                                            <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500"
                                                id="image_error"></span> </div>
                                        </div>
                                        <div>
                                            <label for="example-text-input" class="form-label">Trạng thái<span class="text text-danger">*</span></label>
                                            <select class="form-select status trang-thai" id="status" name="status">
                                                <option value="">--- Chọn trạng thái ---</option>
                                                <option value="published">Được phát hành</option>
                                                <option value="inactive">Không hoạt động</option>
                                                <option value="scheduled">Lên kế hoạch</option>
                                            </select>
                                            <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500"
                                                id="status_error"></span> </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="">Mô tả</label>
                                        <textarea id="description" cols="30" rows="10" name="description"></textarea>
                                        <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500"
                                            id="description_error"></span> </div>
                                    </div>
                                </div>
                                <div class="modal-footer m-2">
                                    <button type="button" onclick="submitaddProduct(event)" class="btn btn-primary w-md">
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

<script>
 CKEDITOR.replace('description');
var validateorder = {
        'name': {
            'element': document.getElementById('name'),
            'error': document.getElementById('name_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E010')
                },
            ]
        },
        'brand_id': {
            'element': document.getElementById('brand_id'),
            'error': document.getElementById('brand_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E027')
                },
            ]
        },
        'category_id': {
            'element': document.getElementById('category_id'),
            'error': document.getElementById('category_id_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E015')
                },
            ]
        },
        'quantity': {
            'element': document.getElementById('quantity'),
            'error': document.getElementById('quantity_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E013')
                },
            ]
        },
        'price': {
            'element': document.getElementById('price'),
            'error': document.getElementById('price_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E012')
                },
            ]
        },
        'priceBuy': {
            'element': document.getElementById('priceBuy'),
            'error': document.getElementById('priceBuy_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E012')
                },
            ]
        },
        'images': {
            'element': document.getElementById('images'),
            'error': document.getElementById('image_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E011')
                },
            ]
        },
        'status': {
            'element': document.getElementById('status'),
            'error': document.getElementById('status_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E017')
                },
            ]
        },
        'description': {
            'element': document.getElementById('description'),
            'error': document.getElementById('description_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E016')
                },
            ]
        },

    }
    function submitaddProduct(event){
        event.preventDefault();
        if(validateAllFields(validateorder)){
            document.getElementById('addproduct').submit();
        }
    }
</script>
@endsection
