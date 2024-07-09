@extends('Admin.Layout.index')
@section('content')
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
                    <a href="#">Thương hiệu</a>
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
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="card-title" style="text-align: center; color:white">Danh sách thương hiệu</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="basic-datatables_length">
                                            <label>Show
                                                <select name="basic-datatables_length" aria-controls="basic-datatables"
                                                    class="form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select> entries
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="basic-datatables_filter" class="dataTables_filter">
                                            <label>Search:
                                                <input type="search" class="form-control form-control-sm" placeholder=""
                                                    aria-controls="basic-datatables">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="basic-datatables"
                                            class="display table table-striped table-hover dataTable" role="grid"
                                            aria-describedby="basic-datatables_info">
                                            <thead>
                                                <tr role="row">
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Logo</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($brand))
                                                    @foreach ($brand as $item)
                                                        <tr>
                                                            <td>{{ $item->name ?? '' }}</td>
                                                            <td><img style="width: 80px; height: 60px;"
                                                                    src="{{ asset($item->logo) ?? '' }}" alt="">
                                                            </td>
                                                            <td>{{ $item->email ?? '' }}</td>
                                                            <td>{{ $item->phone ?? '' }}</td>
                                                            <td>{{ $item->address ?? '' }}</td>
                                                            <td>
                                                                <a class="btn btn-danger btn-sm"
                                                                    href="{{ route('admin.brand.edit', ['id' => $item->id]) }}">Edit</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <!-- Handle empty user case -->
                                                @endif
                                            </tbody>
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
                                                    id="basic-datatables_previous">
                                                    <a href="#" aria-controls="basic-datatables" data-dt-idx="0"
                                                        tabindex="0" class="page-link">Previous</a>
                                                </li>
                                                <li class="paginate_button page-item active">
                                                    <a href="#" aria-controls="basic-datatables" data-dt-idx="1"
                                                        tabindex="0" class="page-link">1</a>
                                                </li>
                                                <li class="paginate_button page-item">
                                                    <a href="#" aria-controls="basic-datatables" data-dt-idx="2"
                                                        tabindex="0" class="page-link">2</a>
                                                </li>
                                                <li class="paginate_button page-item">
                                                    <a href="#" aria-controls="basic-datatables" data-dt-idx="3"
                                                        tabindex="0" class="page-link">3</a>
                                                </li>
                                                <li class="paginate_button page-item">
                                                    <a href="#" aria-controls="basic-datatables" data-dt-idx="4"
                                                        tabindex="0" class="page-link">4</a>
                                                </li>
                                                <li class="paginate_button page-item">
                                                    <a href="#" aria-controls="basic-datatables" data-dt-idx="5"
                                                        tabindex="0" class="page-link">5</a>
                                                </li>
                                                <li class="paginate_button page-item">
                                                    <a href="#" aria-controls="basic-datatables" data-dt-idx="6"
                                                        tabindex="0" class="page-link">6</a>
                                                </li>
                                                <li class="paginate_button page-item next" id="basic-datatables_next">
                                                    <a href="#" aria-controls="basic-datatables" data-dt-idx="7"
                                                        tabindex="0" class="page-link">Next</a>
                                                </li>
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

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"></script>

    @if (session('success'))
        <script>
            $(document).ready(function() {
                $.notify({
                    icon: 'icon-bell',
                    title: 'Thương hiệu',
                    message: '{{ session('success') }}',
                }, {
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

<!-- Custom CSS to enhance appearance -->
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
    .btn-danger {
        border-radius: 20px;
        padding: 5px 15px;
        font-size: 14px;
        font-weight: bold;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .btn-warning:hover,
    .btn-danger:hover {
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
