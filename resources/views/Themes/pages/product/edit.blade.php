@extends('Themes.layouts.app')
@section('content')
<div class="container">

    <div class="table-responsive table-card mt-100 mb-100">
        <div class="row">
            <div class="col-12" style="margin-bottom: 30px">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Sửa Sản Phẩm</h4>

                </div>
            </div>
        </div>
        @if (session('success'))
        <div class="alert alert-success h-10  mb-2 p-2 col-lg-12">
            {{ session('success') }}
        </div>
        @endif
        <!-- end page title -->

        <div class="row">
            <div class="col-12" >
                <div class="card">
                    <div class="card-body p-4" style="margin: 0px auto;">
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
            </div> <!-- end col -->
        </div>


    </div>
</div>
<style>
    .col-lg-6>div {
        margin-bottom: 20px;
    }
    .close-icon {
    position: absolute;
    top: 0;
    right: 0;
    color: red;
    background-color: white;
    border-radius: 50%;
    padding: 2px;
    text-align: center; /
    font-size: 18px;
    line-height: 1;
    cursor: pointer;
}

.close-icon i {
    pointer-events: none; /* Để biểu tượng không chặn sự kiện của thẻ <a> */
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
    function submitForm() {
        document.getElementById('addproduct').submit();
    }
    CKEDITOR.replace('description');
</script>
@endsection
