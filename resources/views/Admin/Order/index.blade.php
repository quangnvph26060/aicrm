@extends('Admin.Layout.index')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#">
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
                    <h4 class="card-title">Basic</h4>
                </div>
                <div class="card-body">
                    <div class="">
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
                                                    <th>Tên khách hàng</th>
                                                    <th>Trạng thái</th>
                                                    <th>Tổng tiền</th>
                                                    <th style="text-align: center">Hành động</th>
                                                </tr>
                                            </tr>
                                        </thead>

                                        @if ($order->count() > 0)
                                        <tbody>

                                            @foreach ($order as $key => $value)
                                                <tr>
                                                    <td>{{ $value->id ?? '' }}</td>
                                                    <td>{{ $value->user_id->name ?? '' }}</td>
                                                    <td>{{ $value->client_id->name ?? '' }}</td>
                                                    @if ($value->status == 1)
                                                    <td class="text-end">
                                                        <span class="badge badge-success">Completed</span>
                                                      </td>
                                                    @else
                                                    <td class="text-end">
                                                        <span class="badge badge-success">Completed</span>
                                                      </td>
                                                    @endif
                                                    <td>{{ number_format($value->total_money ?? '') }} VND</td>
                                                    <td style="text-align:center">
                                                        <a class="btn btn-warning"
                                                            href="{{ route('admin.order.detail', ['id' => $value->id]) }}">Sửa</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <tbody>
                                            <td class="text-center" colspan="10">
                                                <div class="">

                                                    Chưa có khách hàng
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
