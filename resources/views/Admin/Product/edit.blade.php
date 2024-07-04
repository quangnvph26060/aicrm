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

                            <form action="{{ route('admin.product.update', ['id'=> $product->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    {{-- <div class="col-lg-12"> --}}
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Tên sản phẩm <span
                                                        class="text text-danger">*</span></label>
                                                <input class="form-control" name="name" type="text" id="example-text-input"
                                                    value="{{ $product->name }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Loại thương
                                                    hiệu<span class="text text-danger">*</span></label>
                                                <select class="form-control" name="category_id" id="" required>
                                                    <option value="">Chọn thương hiệu</option>
                                                    @foreach ($brand as $item )
                                                    <option {{ $product->brands->id == $item->id ? 'selected' : ''
                                                        }} value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-search-input" class="form-label">Giá nhập
                                                    <span class="text text-danger">*</span></label>
                                                <input required class="form-control" name="price" type="number"
                                                    id="example-search-input" value="{{ $product->price }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-search-input" class="form-label">Giá bán
                                                    <span class="text text-danger">*</span></label>
                                                <input required class="form-control" name="priceBuy" type="number"
                                                    id="example-search-input" value="{{ $product->priceBuy }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">Số lượng <span
                                                        class="text text-danger">*</span></label>
                                                <input required class="form-control" name="quantity" type="number"
                                                    id="example-email-input" value="{{ $product->quantity }}">
                                            </div>


                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Loại Danh
                                                    Mục<span class="text text-danger">*</span></label>
                                                <select class="form-control" name="category_id" id="" required>
                                                    <option value="">Chọn danh mục</option>
                                                    @foreach ($category as $item )
                                                    <option {{ $product->category_id == $item->id ? 'selected' : ''
                                                        }} value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Trạng thái<span
                                                        class="text text-danger">*</span></label>
                                                <select class="form-control" name="status" id="">
                                                    <option value="">Chọn trạng thái</option>
                                                    <option {{ $product->status == 'published' ? 'selected' : '' }}
                                                        value="published">Được phát hành</option>
                                                    <option {{ $product->status == 'inactive' ? 'selected' : '' }}
                                                        value="inactive">Không hoạt động</option>
                                                    <option {{ $product->status == 'scheduled' ? 'selected' : '' }}
                                                        value="scheduled">Lên kế hoạch</option>
                                                </select>
                                            </div>
                                        </div>

                                    {{-- </div> --}}

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Ảnh sản phẩm <span
                                                    class="text text-danger"></span></label>

                                            <input id="images" class="form-control" type="file" name="images[]" multiple
                                                accept="image/*">
                                            <div style="display: flex">
                                                @foreach($product->images as $key => $item)
                                                <div style="position: relative; margin-top: 10px; margin-right: 10px;">
                                                    <img title="{{ $item->image_path }}" style="width: 100px; height: 75px;"
                                                        src="{{ asset($item->image_path) }}" alt="">
                                                    <a title="Xóa"
                                                        href=""
                                                        class="close-icon">
                                                        <i class="fas fa-minus-square"></i>
                                                    </a>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="example-url-input" class="form-label">Mô tả <span
                                                    class="text text-danger">*</span></label>
                                            <textarea class="form-control" id="description" name="description"
                                                rows="2"> {{ $product->description }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md">
                                                Xác nhận
                                            </button>
                                        </div>
                                    </div>
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
