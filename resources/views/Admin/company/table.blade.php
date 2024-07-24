<table id="basic-datatables" class="display table table-striped table-hover dataTable" role="grid"
    aria-describedby="basic-datatables_info">
    <thead>
        <tr>
            <th>STT</th>
            <th>Nhà cung cấp</th>
            <th>SĐT</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th style="text-align: center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @if ($companies && $companies->count() > 0)
            @foreach ($companies as $key => $value)
                @if (is_object($value))
                    <tr>
                        <td>{{ ($companies->currentPage() - 1) * $companies->perPage() + $loop->index + 1 }}
                        </td>
                        <td>{{ $value->name ?? '' }}</td>
                        <td>{{ $value->phone ?? '' }}</td>
                        <td>{{ $value->email ?? '' }}</td>
                        <td>{{ $value->address ?? '' }}</td>
                        <td style="text-align:center">
                            <a class="btn btn-warning"
                                href="{{ route('admin.company.detail', ['id' => $value->id]) }}">Sửa</a>
                            <button class="btn btn-danger btn-delete" data-id="{{ $value->id }}">Xóa</button>
                            @if ($value->hasRepresentative())
                                <a class="btn btn-primary"
                                    href="{{ route('admin.supplier.index', ['company_id' => $value->id]) }}">
                                    Người đại diện
                                </a>
                            @else
                                <a class="btn btn-primary"
                                    href="{{ route('admin.supplier.add', ['company_id' => $value->id]) }}">
                                    Thêm người đại diện
                                </a>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        @else
            <tr>
                <td class="text-center" colspan="6">
                    <div class="">
                        Chưa có nhà cung cấp
                    </div>
                </td>
            </tr>
        @endif
    </tbody>
</table>
