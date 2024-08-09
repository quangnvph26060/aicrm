@extends('superadmin.layout.index')

@section('content')
    <style>
        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            white-space: nowrap;
        }
    </style>

    <div class="container-fluid">
        <h2>Danh sách tin nhắn đã gửi</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>OA</th>
                        <th>Tên</th>
                        <th>Số điện thoại</th>
                        <th>Ngày gửi</th>
                        <th>Template</th>
                        <th>Phí</th>
                        <th>Trạng thái</th>
                        <th>Nguyên nhân</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                        <tr>
                            <td>{{ $message->zaloOa->name }}</td>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->phone }}</td>
                            <td>{{ \Carbon\Carbon::parse($message->sent_at)->format('H:i:s d/m/Y') }}</td>
                            <td>{{ $message->template->template_name }}</td>
                            <td>{{ $message->template->price }}</td>
                            <td>
                                @if ($message->status == 1)
                                    Thành công
                                @else
                                    Thất bại
                                @endif
                            </td>
                            <td>{{ $message->note }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
