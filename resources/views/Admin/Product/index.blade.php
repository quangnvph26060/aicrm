@extends('admin.layout.index')

@section('content')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* Your existing styles */
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
        #category_kho {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #category_kho h2 {
        color: #343a40;
        margin-bottom: 20px;
        font-weight: bold;
    }

    #category_kho label {
        padding: 0px 25px;
    }

    #category_kho .form-control {
        border-radius: 20px;
        padding: 10px 20px;
        font-size: 1.1em;
    }

    #category_kho .form-check-input {
        margin-top: 6px;
    }

    #category_kho .form-check-label {
        font-size: 1.1em;
    }

    #category_kho .form-check {
        margin-bottom: 10px;
    }

    </style>

    <div class="page-inner">
        <div class="page-header">
            <!-- Breadcrumbs here -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="text-align: center; color:white">Danh sách sản phẩm</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="dataTables_length" id="basic-datatables_length">
                                            <a class="btn btn-primary" href="{{ route('admin.product.addForm') }}">Thêm sản
                                                phẩm</a>

                                                <a class="btn btn-primary" href="{{ route('admin.product.formimport') }}">Import excel</a>
                                                <a class="btn btn-primary" data-toggle="modal" data-target="#exportModal">Export excel</a>

                                                <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exportModalLabel">Xuất file danh sách sản phẩm</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="modal-body" id="category_kho">

                                                                    <div class="row">
                                                                        {{-- <div class="col-lg-12 mb-3" id="searh_category">
                                                                            <input type="text" class="form-control" placeholder="Tìm kiếm nhóm hàng">
                                                                        </div> --}}
                                                                        <div class="col-lg-12">
                                                                            <div class="form-check mb-3">
                                                                                <input class="form-check-input" type="checkbox" id="selectAll">
                                                                                <label class="form-check-label" for="selectAll" style="font-size: 14px">
                                                                                    Chọn tất cả loại hàng
                                                                                </label>
                                                                            </div>
                                                                            <form id="checkboxForm_category">
                                                                                <div class="row">
                                                                                    @foreach ($category as $item)
                                                                                        <div class="col-lg-6 mb-2">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" name='category[]' type="checkbox" value="{{ $item->id }}" id="checkbox{{ $item->id }}">
                                                                                                <label class="form-check-label" for="checkbox{{ $item->id }}">
                                                                                                    {{ $item->name }}
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                                <button type="button" class="btn btn-secondary" id="exportproduct" data-dismiss="modal">Xuất</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <form action="{{ route('admin.product.findName') }}" method="GET">
                                            <div id="basic-datatables_filter" class="dataTables_filter">
                                                <label>Tìm kiếm:<input name="name" type="search"
                                                        class="form-control form-control-sm" placeholder=""
                                                        aria-controls="basic-datatables"></label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" id="product-table">
                                        @include('admin.product.table', ['products' => $product])
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" id="pagination">
                                        {{ $product->links('vendor.pagination.custom') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript code -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle delete button click
            $(document).on('click', '.btn-delete', function() {
                if (confirm('Bạn có chắc chắn muốn xóa?')) {
                    var productId = $(this).data('id');
                    var deleteUrl = '{{ route('admin.product.delete', ['id' => ':id']) }}';
                    deleteUrl = deleteUrl.replace(':id', productId);

                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            if (response.success) {
                                // Update the table and pagination with the new HTML
                                $('#product-table').html(response.table);
                                $('#pagination').html(response.pagination);

                                $.notify({
                                    icon: 'icon-bell',
                                    title: 'Sản phẩm',
                                    message: response.message,
                                }, {
                                    type: 'success',
                                    placement: {
                                        from: "bottom",
                                        align: "right"
                                    },
                                    time: 1000,
                                });
                            } else {
                                $.notify({
                                    icon: 'icon-bell',
                                    title: 'Sản phẩm',
                                    message: response.message,
                                }, {
                                    type: 'danger',
                                    placement: {
                                        from: "bottom",
                                        align: "right"
                                    },
                                    time: 1000,
                                });
                            }
                        },
                        error: function(xhr) {
                            $.notify({
                                icon: 'icon-bell',
                                title: 'Sản phẩm',
                                message: 'Xóa sản phẩm thất bại!',
                            }, {
                                type: 'danger',
                                placement: {
                                    from: "bottom",
                                    align: "right"
                                },
                                time: 1000,
                            });
                        }
                    });
                }
            });

            @if (session('success'))
                $.notify({
                    icon: 'icon-bell',
                    title: 'Sản phẩm',
                    message: '{{ session('success') }}',
                }, {
                    type: 'secondary',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    time: 1000,
                });
            @endif
        });
    </script>

    <script>
         document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('#checkboxForm_category .form-check-input');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });


    </script>

<!-- Đảm bảo bạn đã bao gồm jQuery trong dự án của bạn -->


<script>
$(document).ready(function() {
    $('#exportproduct').on('click', function() {
        // Lấy tất cả các checkbox đã chọn
        const selectedCategories = $('#checkboxForm_category input[type="checkbox"]:checked')
            .map(function() {
                return $(this).val();
            }).get();

        if(selectedCategories.length == 0){
            alert('Vui lòng chọn ít nhất một loại hàng để xuất.');
            return;
        }
        const exportUrl = '{{ route('admin.product.export1') }}';
        $.ajax({
            url: exportUrl,
            method: 'GET',
            data: {
                categories: JSON.stringify(selectedCategories) // Gửi danh sách ID của các loại hàng
            },
            xhrFields: {
                responseType: 'blob' // Để nhận dữ liệu dạng blob
            },
            success: function(data) {
                const url = window.URL.createObjectURL(new Blob([data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'products.xlsx');
                document.body.appendChild(link);
                link.click();
                link.remove();
                $('#checkboxForm_category input[type="checkbox"]').prop('checked', false);

            },
            error: function(xhr, status, error) {
                console.error('Có lỗi xảy ra:', error);
            }
        });
    });
});
</script>


@endsection
