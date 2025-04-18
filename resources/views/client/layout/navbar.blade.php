<div class="site-navbar-top">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                <form action="" class="site-block-top-search">
                    <span class="icon icon-search2"></span>
                    <input type="text" class="form-control border-0" placeholder="Search">
                </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                <div class="site-logo">
                    <a href="{{ route('home') }}" class="js-logo-clone">Shoppers</a>
                </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                <div class="site-top-icons">
                    <ul>
                        <li class="nav-item dropdown">
                            @auth
                                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="icon icon-person m-2"></i>
                                    <span>{{ Auth::user()->name ?? Auth::user()->email }}</span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end shadow animated fadeIn text-center">
                                    <li>
                                        <a class="dropdown-item" href="{{ Auth::user()->role == 1 ? route('admin.dashboard') : route('user.dashboard') }}">
                                            <i class="fa fa-user me-2"></i> Trang cá nhân
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="px-3">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Bạn có muốn đăng xuất không?')">
                                                <i class="fa fa-sign-out me-2"></i> Đăng xuất
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            @else
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="icon icon-person"></i>
                                </a>
                            @endauth
                        </li>
                        

                        <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                        <li>
                            <a href="{{ route('carts.index') }}" class="site-cart">
                                <span class="icon icon-shopping_cart"></span>
                                <span class="count">2</span>
                            </a>
                        </li>
                        <li class="d-inline-block d-md-none ml-md-0"><a href="#"
                                class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<nav class="site-navigation text-right text-md-center" role="navigation">
    <div class="container">
        <ul class="site-menu js-clone-nav d-none d-md-block">
            <li>
                <a href="{{ route('home') }}">Trang Chủ</a>
            </li>
            <li class="has-children">
                <a href="$">Danh Mục</a>
                <ul class="dropdown">
                    <li><a href="#">Categories One</a></li>
                    <li><a href="#">Categories Two</a></li>
                    <li><a href="#">Categories Three</a></li>
                </ul>
            </li>
            <li><a href="{{ route('shop') }}">Cửa Hàng</a></li>
            <li><a href="{{ route('about') }}">Về Chúng Tôi</a></li>
            <li><a href="{{ route('contact') }}">Liên Hệ</a></li>
        </ul>
    </div>
</nav>
