<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('images/aicrm1.png') }}" alt="navbar brand" class="navbar-brand" height="20" />
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
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Tổng quan</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Hệ thống quản lý</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarsanpham">
                        <i class="fas fa-box-open"></i>
                        <p>Sản phẩm</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarsanpham">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.product.store') }}">
                                    <span class="sub-item">Danh sách sản phẩm</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.category.index') }}">
                                    <span class="sub-item">Danh mục</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.brand.store') }}">
                                    <span class="sub-item">Thương hiệu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarnhacungcap">
                        <i class="fas fa-building"></i>
                        <p>Nhà cung cấp</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarnhacungcap">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.supplier.index') }}">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.supplier.add') }}">
                                    <span class="sub-item">Nhà cung cấp mới</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.order.index') }}">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Đơn hàng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.check.index') }}">
                        <i class="fas fa-clipboard-check"></i>
                        <p>Phiếu kiểm kho</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarnhanvien">
                        <i class="fas fa-user-tie"></i>
                        <p>Nhân viên</p>
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
                                    <span class="sub-item">Thêm nhân viên</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarthuchi">
                        <i class="fas fa-chart-line"></i>
                        <p>Quản lý thu chi</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarthuchi">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="">
                                    <span class="sub-item">Phiếu thu</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Phiếu chi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.config.detail', ['id' => session('authUser')->id]) }}">
                        <i class="fas fa-cogs"></i>
                        <p>Cấu hình</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.support.lienhe') }}">
                        <i class="fas fa-medkit"></i>
                        <p>Hỗ trợ</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarbaocao">
                        <i class="fas fa-chart-line"></i>
                        <p>Báo cáo</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarbaocao">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.client.index') }}">
                                    <span class="sub-item">Khách hàng</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Thống kê ngày</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Công nợ</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="">
                                            <span class="sub-item">Khách hàng</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <span class="sub-item">Nhà cung cấp</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>
