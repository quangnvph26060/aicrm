<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên thương hiệu</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($brand as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->created_at->format('d/m/Y') ?? '' }}</td>
                <td>
                    <a href="{{ route('admin.brand.edit', $item->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <button type="button" data-id="{{ $item->id }}"
                        class="btn btn-danger btn-sm btn-delete">Xóa</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">Không có dữ liệu</td>
            </tr>
        @endforelse
    </tbody>
</table>
