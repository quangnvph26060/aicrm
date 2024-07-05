@extends('Admin.Layout.index')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{route('admin.dashboard')}}">
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
                        <h4 class="card-title" style="text-align: center">Danh sách đơn hàng</h4>
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
                                    <div class="col-md-6 mb-3">
                                        <div class="d-inline-block">
                                            <button type="submit" class="btn btn-primary">Lọc</button>
                                        </div>
                                        <div class="d-inline-block ml-2">
                                            <button type="button" onclick="window.location.href='{{ route('admin.order.index') }}'" class="btn btn-danger">Xóa</button>
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
