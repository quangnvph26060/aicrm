@extends('Themes.layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
    .align-top {
        top: 3rem !important;

    }
    table {
        box-sizing: content-box;
    }
</style>
<div class="container">

    <div class=" table-card mt-100 mb-100">
        <div class="row d-flex justify-content-end">
            <div class=" d-flex justify-content-end mb-2">
                <div class="dropdown">

                    <button id="openModalProduct" class="dropbtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
                            <path fill="currentColor"
                                d="M8.25 3a.5.5 0 0 1 .5.5v3.75h3.75a.5.5 0 0 1 .5.5v.5a.5.5 0 0 1-.5.5H8.75v3.75a.5.5 0 0 1-.5.5h-.5a.5.5 0 0 1-.5-.5V8.75H3.5a.5.5 0 0 1-.5-.5v-.5a.5.5 0 0 1 .5-.5h3.75V3.5a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        Nhân viên
                    </button>


                    <div class="modal fade" id="myModalProduct" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Thêm Nhân Viên Mới</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.staff.add') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="new-user-name">Tên:</label>
                                                    <input type="text" class="form-control" id="new-user-name"
                                                        name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="new-user-email">Email:</label>
                                                    <input type="email" class="form-control" id="new-user-email"
                                                        name="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="new-user-phone">Số điện thoại:</label>
                                                    <input type="text" class="form-control" id="new-user-phone"
                                                        name="phone">
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="new-user-address">Địa chỉ:</label>
                                                    <input type="text" class="form-control" id="new-user-address"
                                                        name="address">
                                                </div>
                                                <div class="form-group">
                                                    <label for="new-user-password">Mật khẩu:</label>
                                                    <input type="password" class="form-control" id="new-user-password"
                                                        name="password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="new-user-password-confirm">Xác nhận mật khẩu:</label>
                                                    <input type="password" class="form-control"
                                                        id="new-user-password-confirm" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Thêm nhân viên</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="dropdown">
                    <button class="dropbtn">Xuất file</button>
                </div>
            </div>
        </div>
        @if (session('success'))
        {{-- <div class="alert alert-success">
            {{ session('success') }}
        </div> --}}
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: ' {{ session('success') }} ',
                toast: true,
                width: '300px',
                padding: '1rem',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                background: '#e8e8f4',
                customClass: {
                        popup: 'align-top'
                    }

                }).then((result) => {
                // Chuyển hướng hoặc thực hiện hành động khác (nếu cần)
                if (result.isConfirmed) {
                    window.location.href = "{{ route('admin.staff.store') }}";
                }
                });
        </script>
        @endif
        <table class="table table-nowrap table-striped-columns mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($user))
                @foreach ($user as $item )
                <tr>
                    <td><a href="#" class="fw-semibold">{{ $item->id }}</a></td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone ?? "" }}</td>
                    <td>{{ $item->address ?? "" }}</td>
                    <td>
                        <button type="button" class=" btn btn-warning" data-toggle="modal"
                            data-target="#userDetailModal" data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                            data-email="{{ $item->email }}" data-phone="{{ $item->phone }}"
                            data-address="{{ $item->address }}">Sửa</button>

                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"
                            href="{{ route('admin.staff.delete', ['id' =>  $item->id]) }}">Xóa</a>
                    </td>
                </tr>
                @endforeach
                @else
                <!-- Handle empty user case -->
                @endif
            </tbody>
        </table>

        <div class="modal fade" id="userDetailModal" tabindex="-1" aria-labelledby="userDetailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userDetailModalLabel">Thông tin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="user-id">ID:</label>
                                <input type="text" class="form-control" id="user-id">
                            </div>
                            <div class="form-group">
                                <label for="user-name">Name:</label>
                                <input type="text" class="form-control" id="user-name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="user-email">Email:</label>
                                <input type="email" class="form-control" id="user-email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="user-phone">Phone:</label>
                                <input type="text" class="form-control" id="user-phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="user-address">Address:</label>
                                <input type="text" class="form-control" id="user-address" name="address">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="save-user-details">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
<script>
    document.getElementById("openModalProduct").addEventListener("click", function() {
        var modal = new bootstrap.Modal(document.getElementById("myModalProduct"), {
            backdrop: "static",
            keyboard: false
        });
        modal.show();
    });

    $('#userDetailModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Nút bấm mà kích hoạt modal
        var userId = button.data('id');
        var userName = button.data('name');
        var userEmail = button.data('email');
        var userPhone = button.data('phone');
        var userAddress = button.data('address');

        var modal = $(this);
        modal.find('.modal-body #user-id').val(userId);
        modal.find('.modal-body #user-name').val(userName);
        modal.find('.modal-body #user-email').val(userEmail);
        modal.find('.modal-body #user-phone').val(userPhone);
        modal.find('.modal-body #user-address').val(userAddress);

        var form = modal.find('form');
        var action = "{{ route('admin.staff.update', ['id' => ':id']) }}".replace(':id', userId);
        form.attr('action', action);
    });

</script>


@endsection
