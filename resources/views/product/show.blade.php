@extends('product.index')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên Sản Phẩm </th>
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
