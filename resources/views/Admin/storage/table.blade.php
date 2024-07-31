<table id="basic-datatables" class="display table table-striped table-hover" role="grid">
    <thead>
        <tr>
            <th>Mã kho hàng</th>
            <th>Tên kho hàng</th>
            <th>Địa điểm</th>
            <th></th>
        </tr>
    </thead>
    @if ($storages->count() > 0)
        <tbody>
            @foreach ($storages as $key => $value)
                <tr id="category-{{ $value->id }}">
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name ?? '' }}</td>
                    <td>{{ $value->location }}</td>
                    <td style="text-align:center">
                        <a class="btn btn-warning"
                            href="{{ route('admin.storage.detail', ['id' => $value->id]) }}">Sửa</a>
                        <button class="btn btn-danger btn-delete" data-id="{{ $value->id }}">Xóa</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @else
        <tbody>
            <tr>
                <td class="text-center" colspan="4">Không tìm thấy kho hàng</td>
            </tr>
        </tbody>
    @endif
</table>