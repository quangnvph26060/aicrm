@extends('Admin.Layout.index')
@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .icon-bell:before {
            content: "\f0f3";
            font-family: FontAwesome;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: #fff;
            margin-bottom: 2rem;
        }

        .card-header {
            background: linear-gradient(135deg, #6f42c1, #007bff);
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
        }

        .breadcrumbs {
            background: #fff;
            padding: 0.75rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .breadcrumbs a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumbs i {
            color: #6c757d;
        }

        .table-responsive {
            margin-top: 1rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table th,
        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .btn-warning,
        .btn-danger,
        .btn-primary  {
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btn-warning:hover,
        .btn-danger:hover,
        .btn-primary:hover {
            transform: scale(1.05);
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .table-hover tbody tr:hover {
            background-color: #e9ecef;
        }

        .dataTables_info,
        .dataTables_paginate {
            margin-top: 1rem;
        }

        .pagination .page-link {
            color: #007bff;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }

        .pagination .page-item:hover .page-link {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .pagination .page-item.active .page-link,
        .pagination .page-item .page-link {
            transition: all 0.3s ease;
        }
    </style>
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Đơn hàng</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Danh sách</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="text-align: center; color:white">Danh sách đơn hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <form action="{{ route('admin.order.filter') }}" method="GET">
                                <div class="row">
                                    <!-- Start Date Input -->
                                    <div class="col-md-4 mb-3">
                                        <label for="start_date">Ngày bắt đầu</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control"
                                            value="{{ old('start_date') }}">
                                    </div>

                                    <!-- End Date Input -->
                                    <div class="col-md-4 mb-3">
                                        <label for="end_date">Ngày kết thúc</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control"
                                            value="{{ old('end_date') }}">
                                    </div>

                                    <!-- Phone Number Input -->
                                    <div class="col-md-4 mb-3">
                                        <label for="phone">Tìm số điện thoại</label>
                                        <input type="text" name="phone" id="phone" class="form-control"
                                            placeholder="Nhập số điện thoại" value="{{ old('phone') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-center mt-2">
                                        <div class="d-inline-block">
                                            <button type="submit" class="btn btn-primary">Lọc</button>
                                        </div>
                                        <div class="d-inline-block ml-2">
                                            <button type="button"
                                                onclick="window.location.href='{{ route('admin.order.index') }}'"
                                                class="btn btn-danger">Xóa</button>
                                        </div>
                                    </div>
                                </div>
                            </form>


                            {{-- <form action="{{ route('admin.order.findByPhone') }}" method="GET">
                                <div class="form-group">
                                    <label for="phone">Filter by Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        placeholder="Enter phone number">
                                </div>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form> --}}
                            <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="basic-datatables"
                                            class="display table table-striped table-hover dataTable" role="grid"
                                            aria-describedby="basic-datatables_info">
                                            <thead>
                                                <tr role="row">
                                                <tr>
                                                    <th>Mã đơn hàng</th>
                                                    <th>Tên nhân viên</th>
                                                    <th>Ngày tạo</th>
                                                    <th>Tên khách hàng</th>
                                                    <th>Trạng thái</th>
                                                    <th>Tổng tiền</th>
                                                </tr>
                                                </tr>
                                            </thead>

                                            @if ($order->count() > 0)
                                                <tbody>
                                                    @foreach ($order as $key => $value)
                                                        <tr>
                                                            <td><a
                                                                    href="{{ route('admin.order.detail', ['id' => $value->id]) }}">{{ $value->id ?? '' }}</a>
                                                            </td>
                                                            <td>{{ $value->user->name ?? '' }}</td>
                                                            <td>{{ $value->created_at }}</td>
                                                            <td>{{ $value->client->name ?? '' }}</td>
                                                            @if ($value->status == 1)
                                                                <td class="text-end">
                                                                    <span class="badge badge-success">Completed</span>
                                                                </td>
                                                            @else
                                                                <td class="text-end">
                                                                    <span class="badge badge-success">Pending</span>
                                                                </td>
                                                            @endif
                                                            <td>{{ number_format($value->total_money ?? '') }} VND</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            @else
                                                <tbody>
                                                    <td class="text-center" colspan="10">
                                                        <div class="">
                                                            Khách hàng này chưa có đơn hàng nào
                                                        </div>
                                                    </td>
                                                </tbody>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="basic-datatables_info" role="status"
                                            aria-live="polite">Showing 1 to 10 of 57 entries</div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                            id="basic-datatables_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled"
                                                    id="basic-datatables_previous"><a href="#"
                                                        aria-controls="basic-datatables" data-dt-idx="0" tabindex="0"
                                                        class="page-link">Previous</a></li>
                                                <li class="paginate_button page-item active"><a href="#"
                                                        aria-controls="basic-datatables" data-dt-idx="1" tabindex="0"
                                                        class="page-link">1</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="basic-datatables" data-dt-idx="2" tabindex="0"
                                                        class="page-link">2</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="basic-datatables" data-dt-idx="3" tabindex="0"
                                                        class="page-link">3</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="basic-datatables" data-dt-idx="4" tabindex="0"
                                                        class="page-link">4</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="basic-datatables" data-dt-idx="5" tabindex="0"
                                                        class="page-link">5</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="basic-datatables" data-dt-idx="6" tabindex="0"
                                                        class="page-link">6</a></li>
                                                <li class="paginate_button page-item next" id="basic-datatables_next"><a
                                                        href="#" aria-controls="basic-datatables" data-dt-idx="7"
                                                        tabindex="0" class="page-link">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
