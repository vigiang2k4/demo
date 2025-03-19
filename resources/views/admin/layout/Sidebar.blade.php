<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile dropdown no-arrow">
            <a href="#" class="nav-link d-flex align-items-center" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="nav-profile-image mt-5 mb-3">
                    <img src="" alt="profile" class="img-profile rounded-circle mt-2" style="width: 80px; height: 30px;" />
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column mt-5">
                    <span class="font-weight-bold mb-2">
                  
                    </span>
                </div>
                <!-- Dropdown toggle icon -->
                <span class="mdi mdi-dots-vertical mdi-24px ms-3 mt-5"></span>
            </a>

            <!-- Dropdown menu -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item bg-red text-center" href="">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Quay về trang chủ
                </a>
                <a class="dropdown-item bg-red text-center" href="">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Hồ sơ
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item bg-yellow" href="#" data-toggle="modal" data-target="#logoutModal">
                    <form action="" method="POST" class=" text-center">
                        @csrf
                        <button type="submit" class="btn badge bg-danger" onclick="return confirm('chắc chắn đằng xuất')">Đăng xuất</button>
                    </form>
                </a>
            </div>
        </li>

        <li class="nav-item">

            <a class="nav-link" href="">
                <span class="menu-title">Trang chủ</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">
                <span class="menu-title">Đơn hàng</span>
                <i class="mdi mdi-clipboard menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('categories.index')}}">
                <span class="menu-title">Danh mục</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('products.index')}}">
                <span class="menu-title">Sản phẩm</span>
                <i class="mdi mdi-tshirt-crew menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('sizes.index')}}">
                <span class="menu-title">Kích cỡ</span>
                <i class="mdi mdi-format-size menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('colors.index')}}">
                <span class="menu-title">Màu sắc</span>
                <i class="mdi mdi-palette menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">
                <span class="menu-title">người dùng</span>
                <i class="mdi mdi-account menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">
                <span class="menu-title">Đánh giá</span>
                <i class="mdi mdi-comment menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">
                <span class="menu-title">Phiếu giảm giá</span>
                <i class="mdi mdi-ticket-percent menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">
                <span class="menu-title">Banner</span>
                <i class="mdi mdi-billboard menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">
                <span class="menu-title">Bài viết</span>
                <i class="mdi mdi-post menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
