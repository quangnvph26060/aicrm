@extends('product.index')
@section('content')

<form class="d-flex" role="search" action="{{route('search')}}" method="post">
    @csrf

    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="inputSearch">
    <button class="btn btn-outline-success" type="submit" name="btn">Search</button>
</form>
@if(!empty($size))
    <div class="alert alert-success">
        <p class="text-center"> Có {{$size}} Sản Phẩm Được Tìm Thấy </p>
    </div>
@endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên Sản Phẩm </th>
            <th scope="col">Ảnh Sản Phẩm </th>
            <th scope="col">Mô tả Sản Phẩm</th>
            <th scope="col">Giá Sản Phẩm </th>
            <th scope="col">Thao Tác </th>
        </tr>
        </thead>
        <tbody>
        @foreach($product as $index=>$item)
            <tr>
                <th scope="row">{{$index+1}}</th>

                <td>{{$item->tensanpham}}</td>
                <td>
                    <img src="/images/{{$item->anhsanpham}}" width="20%">
                </td>
                <td>{{$item->mota}}</td>
                <td>{{$item->giasanpham}}</td>
                <td>
                    <a  href="{{url('edit/'.$item->id)}}">
                        <button  type="submit" class="btn btn-primary" > Cập Nhật</button>
                    </a>
                    <a onclick=" return confirm('bạn có muốn xóa không')" href="{{url('deleteproduct/'.$item->id)}}">
                        <button  type="submit" class="btn btn-warning" > Xóa</button>
                    </a>
                </td>
            </tr>
        @endforeach



        </tbody>
    </table>
    <button class="btn btn-primary">
        <a href="/getAdd" class="btn btn-primary">Thêm Mới</a>
    </button>
@endsection
