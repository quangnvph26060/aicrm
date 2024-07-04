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

                            <form action="{{ route('admin.category.update', ['id' => $category->id]) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-12">

                                            <label for="example-text-input" class="form-label">Danh Mục</label>
                                            <input required class="form-control" name="name" value="{{ $category->name }}"
                                                type="text" id="example-text-input">
                                        </div>
                                        <div class="mb-12">
                                            <label for="example-text-input" class="form-label">Mô tả</label>
                                            <textarea required class="form-control" name="description" id="description" rows="4">{!! $category->description !!}</textarea>
                                        </div>

                                    </div>
                                    <div class="col-lg-12">
                                        <div style="margin: 20px; text-align: center">
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
