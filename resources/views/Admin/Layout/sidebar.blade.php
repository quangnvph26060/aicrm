<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a  href="{{ route('admin.dashboard') }}" >
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>

                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Thành phần quản lý</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarsanpham">
                        <i class="fas fa-th-list"></i>
                        <p>Sản phẩm </p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarsanpham">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.product.store') }}">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.product.addForm') }}">
                                    <span class="sub-item">Thêm sản phẩm </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarthuonghieu">
                        <i class="fas fa-th-list"></i>
                        <p>Danh mục </p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarthuonghieu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.category.index') }}">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.category.add') }}">
                                    <span class="sub-item">Thêm thương hiệu </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarnhanvien">
                        <i class="fas fa-th-list"></i>
                        <p>Nhân viên </p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarnhanvien">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.staff.store') }}">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.staff.addForm') }}">
                                    <span class="sub-item">Thêm nhân viên  </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarbrand">
                        <i class="fas fa-th-list"></i>
                        <p>Thương hiệu </p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarbrand">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.brand.store') }}">
                                    <span class="sub-item">Danh sách </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.brand.addForm') }}">
                                    <span class="sub-item">Thêm thương hiệu </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarordẻ">
                        <i class="fas fa-th-list"></i>
                        <p>Đơn hàng  </p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarordẻ">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="sidebar-style-2.html">
                                    <span class="sub-item">Danh sách </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarclient">
                        <i class="fas fa-th-list"></i>
                        <p>Khách hàng   </p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarclient">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="sidebar-style-2.html">
                                    <span class="sub-item">Danh sách </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
    const navLink = document.querySelector('.nav-link');
    const collapseElement = document.querySelector('.collapse');

    navLink.addEventListener('click', function (event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a
        if (collapseElement.classList.contains('show')) {
            collapseElement.classList.remove('show');
        } else {
            collapseElement.classList.add('show');
        }
    });
});

</script> --}}
