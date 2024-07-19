<!-- resources/views/admin/product/table.blade.php -->
<table id="basic-datatables" class="display table table-striped table-hover dataTable" role="grid"
    aria-describedby="basic-datatables_info">
    <thead>
        <tr role="row">
            <th>STT</th>
            <th>Tên</th>
            <th>Thương hiệu</th>
            <th>Số lượng</th>
            <th>Giá nhập</th>
            <th>Giá bán</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($product as $key => $value)
            <tr id="product-{{ $value->id }}">
                <td>{{ ($product->currentPage() - 1) * $product->perPage() + $loop->index + 1 }}</td>
                <td>{{ $value->name ?? '' }}</td>
                <td>{{ $value->brands->name ?? '' }}</td>
                <td>{{ $value->quantity ?? '' }}</td>
                <td>{{ number_format($value->price) ?? '' }} đ</td>
                <td>{{ number_format($value->priceBuy) ?? '' }} đ</td>
                <td align="center">
                    <a class="btn btn-warning" href="{{ route('admin.product.edit', ['id' => $value->id]) }}">Sửa</a>
                    <button class="btn btn-danger btn-delete" data-id="{{ $value->id }}">Xóa</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{-- <div id="pagination">
    {{ $product->links('vendor.pagination.custom') }}
</div> --}}
