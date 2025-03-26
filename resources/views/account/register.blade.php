@extends('account.master')

@section('title')
    Đăng ký tài khoản
@endsection

@section('content')
    <span class="login100-form-title p-b-49">
        Đăng ký tài khoản
    </span>

    <div class="wrap-input100 validate-input m-b-23 m-3" data-validate="Vui lòng nhập email">
        <span class="label-input100">Email</span>
        <input class="input100" type="email" name="email" placeholder="Nhập email của bạn">
        <span class="focus-input100" data-symbol="&#xf1fa;"></span>
    </div>

    <div class="wrap-input100 validate-input m-3" data-validate="Vui lòng nhập mật khẩu">
        <span class="label-input100">Mật khẩu</span>
        <input class="input100" type="password" name="password" placeholder="Tạo mật khẩu">
        <span class="focus-input100" data-symbol="&#xf190;"></span>
    </div>

    <div class="wrap-input100 validate-input m-3" data-validate="Vui lòng xác nhận mật khẩu">
        <span class="label-input100">Xác nhận mật khẩu</span>
        <input class="input100" type="password" name="confirm_password" placeholder="Nhập lại mật khẩu">
        <span class="focus-input100" data-symbol="&#xf190;"></span>
    </div>

    <div class="container-login100-form-btn mt-3 m-3">
        <div class="wrap-login100-form-btn">
            <div class="login100-form-bgbtn"></div>
            <button class="login100-form-btn">
                Đăng ký
            </button>
        </div>
    </div>

    <div class="text-center p-t-8 p-b-31">
        <a href="{{ route('login') }}">
            Đã có tài khoản? Đăng nhập
        </a>
    </div>
@endsection
