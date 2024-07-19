<table id="basic-datatables" class="display table table-striped table-hover dataTable" role="grid"
    aria-describedby="basic-datatables_info">
    <thead>
        <tr role="row">
            <th scope="col">Tên thương hiệu</th>
            <th scope="col">Logo</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($brand))
            @foreach ($brand as $item)
                <tr>
                    <td>{{ $item->name ?? '' }}</td>
                    <td><img style="width: 5rem; height: 3.75rem;" src="{{ asset($item->logo) ?? '' }}" alt="">
                    </td>
                    <td>
                        <a class="btn btn-warning"
                            href="{{ route('admin.brand.edit', ['id' => $item->id]) }}">Sửa</a>
                        <button class="btn btn-danger btn-delete" data-id="{{ $item->id }}">Xóa</button>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-center" colspan="7">
                    <div class="">Chưa có thương hiệu</div>
                </td>
            </tr>
        @endif
    </tbody>
</table>
