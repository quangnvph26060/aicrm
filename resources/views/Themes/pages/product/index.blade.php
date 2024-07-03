@extends('Themes.layouts.app')
@section('content')
<style>
    .modal-open {
    overflow: hidden;
}

</style>
<div class="container">
    <div class="table-card mt-100 mb-100">
        <div class="row d-flex justify-content-end">
            <div class=" d-flex justify-content-end mb-2">
                <div class="dropdown">

                    <button class="dropbtn"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 16 16">
                            <path fill="currentColor"
                                d="M8.25 3a.5.5 0 0 1 .5.5v3.75h3.75a.5.5 0 0 1 .5.5v.5a.5.5 0 0 1-.5.5H8.75v3.75a.5.5 0 0 1-.5.5h-.5a.5.5 0 0 1-.5-.5V8.75H3.5a.5.5 0 0 1-.5-.5v-.5a.5.5 0 0 1 .5-.5h3.75V3.5a.5.5 0 0 1 .5-.5z" />
                        </svg>Thêm mới</button>
                    <div class="dropdown-content">
                        <p id="openModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
                                <path fill="currentColor"
                                    d="M8.25 3a.5.5 0 0 1 .5.5v3.75h3.75a.5.5 0 0 1 .5.5v.5a.5.5 0 0 1-.5.5H8.75v3.75a.5.5 0 0 1-.5.5h-.5a.5.5 0 0 1-.5-.5V8.75H3.5a.5.5 0 0 1-.5-.5v-.5a.5.5 0 0 1 .5-.5h3.75V3.5a.5.5 0 0 1 .5-.5z" />
                            </svg>
                            Thêm danh mục
                        </p>
                        <!-- Modal -->
                        <div id="myModal" class="modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="varyingcontentModalLabel">Thêm danh mục</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Tên danh mục:</label>
                                                <input type="text" class="form-control" id="recipient-name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="message-text" class="col-form-label">Mô tả:</label>
                                                <textarea class="form-control" id="message-text"></textarea>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary">Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p id="openModalProduct">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
                                <path fill="currentColor"
                                    d="M8.25 3a.5.5 0 0 1 .5.5v3.75h3.75a.5.5 0 0 1 .5.5v.5a.5.5 0 0 1-.5.5H8.75v3.75a.5.5 0 0 1-.5.5h-.5a.5.5 0 0 1-.5-.5V8.75H3.5a.5.5 0 0 1-.5-.5v-.5a.5.5 0 0 1 .5-.5h3.75V3.5a.5.5 0 0 1 .5-.5z" />
                            </svg>Thêm sản phẩm
                        </p>
                        <div id="myModalProduct" class="modal"  tabindex="-1" aria-labelledby="myModalLabel"  aria-hidden="true" data-backdrop="static" data-keyboard="true">
                            <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="varyingcontentModalLabelProduct">Thêm sản phẩm</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="{{ route('admin.product.add') }}" method="POST"
                                            enctype="multipart/form-data" id="addproduct">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label for="placeholderInput" class="form-label">Tên sản
                                                            phẩm</label>
                                                        <input type="text" class="form-control" name="name" id="name">
                                                    </div>
                                                    <div>
                                                        <label for="placeholderInput" class="form-label">Thương
                                                            hiệu</label>
                                                        <select class="form-control" name="brand_id" id="brand_id"
                                                            required>
                                                            <option value="">Chọn danh mục</option>
                                                            @foreach ($brand as $item )
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div>
                                                        <label for="example-text-input" class="form-label">Loại Danh
                                                            Mục<span class="text text-danger">*</span></label>
                                                        <select class="form-control" name="category_id" id="category_id"
                                                            required>
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
                                                        <input value="" required class="form-control" name="quantity"
                                                            type="number" id="quantity">
                                                    </div>


                                                </div>
                                                <div class="col-lg-6">

                                                    <div>
                                                        <label for="example-search-input" class="form-label">Giá
                                                            nhập<span class="text text-danger">*</span></label>
                                                        <input value="" required class="form-control" name="price"
                                                            type="number" id="price">
                                                    </div>

                                                    <div>
                                                        <label for="example-search-input" class="form-label">Giá
                                                            bán<span class="text text-danger">*</span></label>
                                                        <input value="" required class="form-control" name="priceBuy"
                                                            type="number" id="priceBuy">
                                                    </div>

                                                    <div>
                                                        <label for="example-text-input" class="form-label">Ảnh sản phẩm
                                                            <span class="text text-danger">*</span></label>

                                                        <input id="images" class="form-control" type="file"
                                                            name="images[]" multiple accept="image/*" required>


                                                    </div>

                                                    <div>
                                                        <label for="example-text-input" class="form-label">Trạng thái
                                                            <span class="text text-danger">*</span></label>
                                                        <select class="form-select status trang-thai" id="status"
                                                            name="status">
                                                            <option value="published">Được phát hành</option>
                                                            <option value="inactive">Không hoạt động</option>
                                                            <option value="scheduled">Lên kế hoạch</option>
                                                        </select>
                                                    </div>


                                                </div>

                                                <div class="col-lg-12">
                                                    <label for="">Mô tả</label>
                                                    <textarea id="description" cols="30" rows="10"
                                                        name="description"></textarea>
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
                <div class="dropdown">
                    <button class="dropbtn">Xuất file</button>
                </div>
            </div>
        </div>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <table class="table table-nowrap table-striped-columns mb-0">
            <thead class="table-light">
                <tr>

                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Thương hiệu</th>
                    <th>Ảnh</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Đơn giá bán</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th style="text-align: center">Hành động</th>
                </tr>
            </thead>
            @if ($product->count() > 0)
            <tbody>

                @foreach($product as $key => $value)
                <tr>

                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->name ?? "" }}</td>
                    <td>{{ $value->brands->name ?? ""}}</td>
                    <td>

                        @if (isset($value->images[0]))
                        <img style="width: 100px; height: 75px;" src="{{asset($value->images[0]->image_path )}}" alt="">
                        @endif

                    </td>
                    <td>{{ $value->quantity ?? "" }}</td>
                    <td>{{ number_format($value->price) ?? "" }} đ</td>
                    <td>{{ number_format($value->priceBuy) ?? "" }} đ</td>
                    <td>
                        <div class="form-group">
                            <select class="form-select category" name="category">
                                @foreach ($category as $item)
                                <option {{ $value->category_id == $item->id ? 'selected' :
                                    ''}}
                                    data-idProduct="{{ $value->id }}" value="{{ $item->id
                                    }}">
                                    {{$item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <select class="form-select status trang-thai" id="status">
                                <option {{ $value->status == 'published' ? 'selected' : ''
                                    }}
                                    data-idProduct="{{ $value->id }}" value="published">Được phát hành</option>
                                <option {{ $value->status == 'inactive' ? 'selected' : '' }}
                                    data-idProduct="{{ $value->id }}" value="inactive">Không hoạt động</option>
                                <option {{ $value->status == 'scheduled' ? 'selected' : ''
                                    }}
                                    data-idProduct="{{ $value->id }}" value="scheduled">Lên kế hoạch</option>
                            </select>
                        </div>
                    </td>
                    <td align="center">
                        <a class="btn btn-warning" href="{{ route('admin.product.edit', ['id'=> $value->id]) }}">Sửa</a>
                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"
                            href="{{ route('admin.product.delete', ['id' =>  $value->id]) }}">Xóa</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @else
            <tbody>
                <td class="text-center" colspan="10">
                    <div class="">

                        Không có sản phẩm cần tìm
                    </div>
                </td>
            </tbody>
            @endif
        </table>
    </div>
</div>
<style>

    .table {
        box-sizing: content-box;
    }
    .table .form-select {
        padding-right: 2rem;
        -moz-appearance: none;
        -webkit-appearance: none;
        appearance: none;

        background: url('data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns%3D%22http%3A//www.w3.org/2000/svg%22 viewBox%3D%220 0 4 5%22%3E%3Cpath fill%3D%22%23000%22 d%3D%22M2 0L0 2h4zM2 5L0 3h4z%22/%3E%3C/svg%3E') no-repeat right 0.75rem center;
        background-size: 0.65rem auto;
    }

    .table .form-select option {
        padding-right: 1rem;
    }

    .col-lg-6>div {
        margin-bottom: 20px;
    }

    .table thead th {
        text-align: center;
    }

    .table tbody td {
        vertical-align: middle;
        text-align: center;
    }

    .table tbody td img {
        display: block;
        margin: 0 auto;
    }

    .table tbody td select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        /* box-sizing: content-box; */
    }

    .table tbody tr {
        transition: background-color 0.3s;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table tbody tr td:last-child a {
        margin: 0 5px;
    }

    .table tbody tr td:last-child a.btn {
        padding: 5px 10px;
        border-radius: 5px;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table tbody tr:nth-child(odd) {
        background-color: #ffffff;
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
