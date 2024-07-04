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
                <a href="#">Sản phẩm</a>
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

                            <form action="{{ route('admin.product.add') }}" method="POST" enctype="multipart/form-data"
                                id="addproduct">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 add_product">
                                        <div>
                                            <label for="placeholderInput" class="form-label">Tên sản
                                                phẩm</label>
                                            <input type="text" class="form-control" name="name" id="name">
                                        </div>
                                        <div>
                                            <label for="placeholderInput" class="form-label">Thương
                                                hiệu</label>
                                            <select class="form-control" name="brand_id" id="brand_id" required>
                                                <option value="">Chọn danh mục</option>
                                                @foreach ($brand as $item )
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <label for="example-text-input" class="form-label">Loại Danh
                                                Mục<span class="text text-danger">*</span></label>
                                            <select class="form-control" name="category_id" id="category_id" required>
                                                <option value="">Chọn danh mục</option>
                                                @foreach ($category as $item )
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                    style="font-weight: 500" id="category_id_error"></span>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="placeholderInput" class="form-label">Tồn kho</label>
                                            <input value="" required class="form-control" name="quantity" type="number"
                                                id="quantity">
                                        </div>


                                    </div>
                                    <div class="col-lg-6 add_product">

                                        <div>
                                            <label for="example-search-input" class="form-label">Giá
                                                nhập<span class="text text-danger">*</span></label>
                                            <input value="" required class="form-control" name="price" type="number"
                                                id="price">
                                        </div>

                                        <div>
                                            <label for="example-search-input" class="form-label">Giá
                                                bán<span class="text text-danger">*</span></label>
                                            <input value="" required class="form-control" name="priceBuy" type="number"
                                                id="priceBuy">
                                        </div>

                                        <div>
                                            <label for="example-text-input" class="form-label">Ảnh sản phẩm
                                                <span class="text text-danger">*</span></label>

                                            <input id="images" class="form-control" type="file" name="images[]" multiple
                                                accept="image/*" required>


                                        </div>

                                        <div>
                                            <label for="example-text-input" class="form-label">Trạng thái
                                                <span class="text text-danger">*</span></label>
                                            <select class="form-select status trang-thai" id="status" name="status">
                                                <option value="published">Được phát hành</option>
                                                <option value="inactive">Không hoạt động</option>
                                                <option value="scheduled">Lên kế hoạch</option>
                                            </select>
                                        </div>


                                    </div>

                                    <div class="col-lg-12" >
                                        <label for="">Mô tả</label>
                                        <textarea id="description" cols="30" rows="10" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer m-2" style="justify-content: center;">
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
