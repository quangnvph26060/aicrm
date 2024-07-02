@extends('Themes.layouts.app')
@section('content')
    <div class="container">
        <div class="table-responsive table-card mt-100 mb-100">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Chỉnh sửa danh mục số {{ $category->id }}</h4>

                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                {{-- <!-- {{ route('category.detail') }} --> --}}
                <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">

                                <label for="example-text-input" class="form-label">Danh Mục</label>
                                <input required class="form-control" name="name" value="{{ $category->name }}"
                                    type="text" id="example-text-input">
                            </div>
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Mô tả</label>
                                <textarea required class="form-control" name="description" id="description" rows="4">{!! $category->description !!}</textarea>
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

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
