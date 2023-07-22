@extends('product.index')
@section('title')
    {{$title}}
@endsection
@section('content')

    <form action="{{url('edit/'.$product->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">

            <label class="form-label">Tên Sản Phẩm</label>

            <input type="text" class="form-control" name="name" value="{{$product->tensanpham}}">
            @error('name')
            <div class="btn btn-danger">
                {{$message}}

            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh Sản Phẩm</label>
            </br>
            <input type="file"  name="anh" >
{{--            lưu lại ảnh cũ--}}
            <img src="{{$product->anhsanpham ? Storage::url($product->anhsanpham):""}}" width="20%">
{{--            <input type="hidden" value="{{$product->anhsanpham}}" name="anhcu">--}}

        </div>
        @error('anh')
        <div class="btn btn-danger">
            {{$message}}
        </div>
        @enderror
        <div class="mb-3">

            <label class="form-label">Mô TẢ Sản Phẩm</label>

            <input type="text" class="form-control" name="mota" value="{{$product->mota}}">
            @error('mota')
            <div class="btn btn-danger">
                {{$message}}

            </div>
            @enderror
        </div>
        <div class="mb-3">

            <label class="form-label">Giá Sản Phẩm</label>

            <input type="text" class="form-control" name="gia" value="{{$product->giasanpham}}">
            @error('gia')
            <div class="btn btn-danger">
                {{$message}}

            </div>
            @enderror
        </div>
        <a href="{{url('show')}}" class="btn btn-primary"> Danh Sách </a>
        <button class="btn btn-success" type="submit">Cập Nhật</button>

    </form>
@endsection

