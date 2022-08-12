<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{asset('dist/img/huy.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{Auth::check() ? Auth::user()->name : ''}}</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.role.list')}}" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                        Phân Quyền
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.role.list')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh Sách</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.role.addForm')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm Mới</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.user.list')}}" class="nav-link">
                    <i class="nav-icon fas fa-user-alt"></i>
                    <p>
                        Tài Khoản
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.user.list')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh Sách</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.user.addForm')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm Mới</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.category.list')}}" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Danh Mục Sản Phẩm
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.category.list')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh Sách</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.category.addForm')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm Mới</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.product.list')}}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Sản Phẩm
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.product.list')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh Sách</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.product.addForm')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm Mới</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="pages/gallery.html" class="nav-link">
                    <i class="nav-icon far fa-image"></i>
                    <p>
                        Ảnh Sản Phẩm
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.image.list')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh Sách</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Bình Luận
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh Sách</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Đơn Hàng
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.order.list')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh Sách</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-envelope"></i>
                    <p>
                        Phản Hồi
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/mailbox/mailbox.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh Sách</p>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Thống Kê
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/charts/chartjs.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Biểu Đồ</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.statistical.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dữ Liệu</p>
                        </a>
                    </li>
                </ul>
            </li>


            
            <li class="nav-header">Lịch Sử</li>
            <li class="nav-item">
                <a href="pages/calendar.html" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                        Đơn Không Hoàn Thành
                    </p>
                </a>
            </li>

            <li class="nav-item" style="margin-bottom: 60px;">
                <a href="pages/kanban.html" class="nav-link">
                    <i class="nav-icon fas fa-columns"></i>
                    <p>
                        Lịch Sử Xóa
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>