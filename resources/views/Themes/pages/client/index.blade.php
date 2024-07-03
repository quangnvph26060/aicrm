@extends('Themes.layouts.app')
@section('content')
    <div class="container">
        <div class="table-card mt-100 mb-100">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-nowrap table-striped-columns mb-0">
                <thead class="table-light">
                    <tr>

                        <th>STT</th>
                        <th>Tên khách hàng</th>
                        <th>SĐT</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th style="text-align: center">Hành động</th>
                    </tr>
                </thead>
                @if ($client->count() > 0)
                    <tbody>

                        @foreach ($client as $key => $value)
                            <tr>

                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->name ?? '' }}</td>
                                <td>{{ $value->phone ?? '' }}</td>
                                <td>{{ $value->email ?? '' }}</td>
                                <td>{{ $value->address ?? '' }}</td>
                                <td style="text-align:center">
                                    <a class="btn btn-warning"
                                        href="{{ route('admin.client.detail', ['id' => $value->id]) }}">Sửa</a>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"
                                        href="{{ route('admin.client.delete', ['id' => $value->id]) }}">Xóa</a>
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
    <style>
        .table {
            box-sizing: content-box;
        }

        .table .form-select {
            padding-right: 2rem;
            -moz-appearance: none;
            -webkit-appearance: none;
            appearance: none;

            background: url('data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns%3D%22http%3A//www.w3.org/2000/svg%22 viewBox%3D%220 0 4 5%22%3E%3Cpath fill%3D%22%23000%22 d%3D%22M2 0L0 2h4zM2 5L0 3h4z%22/%3E%3C/svg%3E') no-repeat right 0.75rem center;
            background-size: 0.65rem auto;
        }

        .table .form-select option {
            padding-right: 1rem;
        }

        .col-lg-6>div {
            margin-bottom: 20px;
        }

        .table thead th {
            text-align: center;
        }

        .table tbody td {
            vertical-align: middle;
            text-align: center;
        }

        .table tbody td img {
            display: block;
            margin: 0 auto;
        }

        .table tbody td select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            /* box-sizing: content-box; */
        }

        .table tbody tr {
            transition: background-color 0.3s;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table tbody tr td:last-child a {
            margin: 0 5px;
        }

        .table tbody tr td:last-child a.btn {
            padding: 5px 10px;
            border-radius: 5px;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }
    </style>
    <script>
        var modal = document.getElementById("myModal");
        var openModal = document.getElementById("openModal");

        openModal.onclick = function() {
            modal.style.display = "block";
        }


        var closeModal = document.querySelector("#myModal .btn-close");

        closeModal.onclick = function() {
            modal.style.display = "none";
        }


        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        var modalProduct = document.getElementById("myModalProduct");
        var openModalProduct = document.getElementById("openModalProduct");

        openModalProduct.onclick = function() {
            modalProduct.style.display = "block";
        }

        var closeModalProduct = document.querySelector("#myModalProduct .btn-close");

        closeModalProduct.onclick = function() {
            modalProduct.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modalProduct) {
                modalProduct.style.display = "none";
            }
        }
    </script>

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        function submitForm() {
            document.getElementById('addproduct').submit();
        }
        CKEDITOR.replace('description');
    </script>
@endsection
