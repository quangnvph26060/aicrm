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
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Basic</h4>
                </div>
                <div class="card-body">
                    <div class="">
                        <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="basic-datatables_length">

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="basic-datatables_filter" class="dataTables_filter"><label>Search:<input
                                                type="search" class="form-control form-control-sm" placeholder=""
                                                aria-controls="basic-datatables"></label></div>
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
                                            @foreach ($brand as $item )
                                            <tr>

                                                <td>{{ $item->name ?? "" }}</td>
                                                <td><img style="width: 80px ; height: 60px;;" src="{{ asset($item->logo) ?? "" }}" alt=""></td>
                                                <td>{{ $item->email ?? "" }}</td>
                                                <td>{{ $item->phone ?? "" }}</td>
                                                <td>{{ $item->address ?? "" }}</td>
                                                <td>
                                                    <a  class="btn btn-danger"
                                                        href="{{ route('admin.brand.edit', ['id' =>  $item->id]) }}">Edit</a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"></script>
@if (session('success'))
<script>
    $(document).ready(function() {
    $.notify({
        icon: 'icon-bell',
        title: 'Thương hiệu',
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
