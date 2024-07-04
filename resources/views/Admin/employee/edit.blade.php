@extends('Admin.Layout.index')
@section('content')
<style>
    .add_product>div{
        margin-top: 20px
    }
</style>
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
                <a href="#">Nhân viên</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Sửa</a>
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
                    <div class="table-responsive">
                        <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                            <form method="post" action="{{ route('admin.staff.update', ['id' => $user->id]) }}}">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="user-name">Name:</label>
                                        <input type="text" class="form-control" id="user-name" name="name" value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="user-email">Email:</label>
                                        <input type="email" class="form-control" id="user-email" name="email" value="{{ $user->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="user-phone">Phone:</label>
                                        <input type="text" class="form-control" id="user-phone" name="phone" value="{{ $user->phone }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="user-address">Address:</label>
                                        <input type="text" class="form-control" id="user-address" name="address" value="{{ $user->address }}">
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin: 20px;">
                                    <button style="text-align: center" type="submit" class="btn btn-primary" id="save-user-details">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    function submitForm() {
        document.getElementById('addproduct').submit();
    }
    CKEDITOR.replace('description');
</script>
@endsection
