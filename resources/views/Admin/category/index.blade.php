@extends('Admin.Layout.index')
@section('content')
<style>
    h4 {
        text-align: center;
        color: white !important;
    }
    .page-header {
        margin-bottom: 30px;
    }
    .breadcrumbs {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
    }
    .breadcrumbs a {
        color: #007bff;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    .breadcrumbs a:hover {
        color: #0056b3;
    }
    .breadcrumbs .separator {
        margin: 0 10px;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .card-header {
        background: linear-gradient(90deg, #007bff, #33b5e5);
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        padding: 15px 20px;
    }
    .card-title {
        margin: 0;
        font-size: 24px;
    }
    .btn-warning, .btn-danger {
        border-radius: 20px;
        padding: 5px 15px;
        font-size: 14px;
        font-weight: bold;
        transition: background 0.3s ease, transform 0.3s ease;
    }
    .btn-warning:hover, .btn-danger:hover {
        transform: scale(1.05);
    }
    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
    }
    .table th, .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }
    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }
    .table tbody + tbody {
        border-top: 2px solid #dee2e6;
    }
    .pagination .page-link {
        color: #007bff;
    }
    .pagination .page-link:hover {
        color: #0056b3;
    }
    .dataTables_info {
        margin: 20px 0;
    }
    .dataTables_filter {
        margin-bottom: 20px;
    }
    .notify {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1050;
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
                <a href="{{ route('admin.category.index') }}">Danh mục</a>
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
                    <h4 class="card-title">Danh sách danh mục</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" role="grid">
                            <thead>
                                <tr>
                                    <th>Mã danh mục</th>
                                    <th>Tên danh mục</th>
                                    <th>Mô tả</th>
                                    <th>Hàng động</th>
                                </tr>
                            </thead>
                            @if ($category)
                            <tbody>
                                @foreach ($category as $key => $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name ?? '' }}</td>
                                    <td>{!! $value->description !!}</td>
                                    <td style="text-align:center">
                                        <a class="btn btn-warning" href="{{ route('admin.category.detail', ['id' => $value->id]) }}">Sửa</a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger" href="{{ route('admin.category.delete', ['id' => $value->id]) }}">Xóa</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>
                    <div class="dataTables_info">Showing 1 to 10 of 57 entries</div>
                    <div class="dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            <li class="paginate_button page-item previous disabled">
                                <a href="#" class="page-link">Previous</a>
                            </li>
                            <li class="paginate_button page-item active">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="paginate_button page-item">
                                <a href="#" class="page-link">2</a>
                            </li>
                            <li class="paginate_button page-item">
                                <a href="#" class="page-link">3</a>
                            </li>
                            <li class="paginate_button page-item">
                                <a href="#" class="page-link">4</a>
                            </li>
                            <li class="paginate_button page-item">
                                <a href="#" class="page-link">5</a>
                            </li>
                            <li class="paginate_button page-item">
                                <a href="#" class="page-link">6</a>
                            </li>
                            <li class="paginate_button page-item next">
                                <a href="#" class="page-link">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"></script>
@if (session('success'))
<script>
    $(document).ready(function() {
        $.notify({
            icon: 'icon-bell',
            title: 'Danh mục',
            message: '{{ session('success') }}',
        },{
            type: 'secondary',
            placement: {
                from: "bottom",
                align: "right"
            },
            time: 1000,
        });
    });
</script>
@endif
@endsection
