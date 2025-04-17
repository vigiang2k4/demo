<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Nhúng Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/css.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZtj4ZqfK1h6vFhRbNQF8rR2S0q6rvj6aq8qC7EwEsmexjSPh5tOKm84x6Y5W" crossorigin="anonymous">
</head>

<body class="container">
    <div class="d-flex mt-5">
        <!-- Phần Menu -->
        <div class="menu-container bg-light p-3 m-3">
            <h3> <span>{{ Auth::user()->name ?? Auth::user()->email }}</span> </h3>
            <a href="/">Tiếp tục mua sắm</a>
            <ul class="menu list-unstyled">
                <li class="dropdown">
                    <button class="dropdown-btn btn btn-light w-100 text-start">
                        <i class="icon-user"></i> Tài Khoản Của Tôi
                    </button>
                    <ul class="dropdown-content list-unstyled ps-3">
                        <li><a href="#">Hồ Sơ</a></li>
                        <li><a href="#">Địa Chỉ</a></li>
                        <li><a href="#">Đổi Mật Khẩu</a></li>
                    </ul>
                </li>
                <li><a href="#" class="btn btn-light w-100 text-start">Đơn Mua</a></li>
                <li class="dropdown">
                    <button class="dropdown-btn btn btn-light w-100 text-start">
                        <i class="icon-user"></i> Thông báo
                    </button>
                    <ul class="dropdown-content list-unstyled ps-3">
                        <li><a href="#">Đơn hàng</a></li>
                        <li><a href="#">Khuyến mãi</a></li>
                        <li><a href="#">Khác</a></li>
                    </ul>
                </li>
                <li><a href="#" class="btn btn-light w-100 text-start">Kho Voucher</a></li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="width: 120px; height: 40px;" class="btn btn-danger" onclick="return confirm('Bạn có muốn đăng xuất không?')">Đăng xuất</button>
                </form>
            </ul>
        </div>

        <!-- Phần Content -->
        <div class="content-container p-4 flex-grow-1 m-3">
            @yield('content')
        </div>

        <!-- Nhúng Bootstrap JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('user/script.js') }}"></script>
</body>

</html>
