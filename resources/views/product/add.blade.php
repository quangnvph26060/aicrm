@extends('product.index')
@section('content')

    <form action="{{route('post.add')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">

            <label class="form-label">Tên Sản Phẩm</label>

            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                @error('name')
            <div class="btn btn-danger">
                {{$message}}

            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh Sản Phẩm</label>
            <input type="file" class="form-control" name="anh" >

        </div>
        @error('anh')
        <div class="btn btn-danger">
            {{$message}}
        </div>
        @enderror
        <div class="mb-3">

            <label class="form-label">Mô TẢ Sản Phẩm</label>

            <input type="text" class="form-control" name="mota" value="{{old('mota')}}">
            @error('mota')
            <div class="btn btn-danger">
                {{$message}}

            </div>
            @enderror
        </div>
        <div class="mb-3">

            <label class="form-label">Giá Sản Phẩm</label>

            <input type="text" class="form-control" name="gia" value="{{old('gia')}}">
            @error('gia')
            <div class="btn btn-danger">
                {{$message}}

            </div>
            @enderror
        </div>

        <button class="btn btn-success" type="submit">Thêm</button>

    </form>
@endsection
