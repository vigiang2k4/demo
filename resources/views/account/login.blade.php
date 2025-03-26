@extends('account.master')

@section('title')
    Đăng nhập
@endsection

@section('content')
    <span class="login100-form-title p-b-49">
        Đăng nhập
    </span>

    <div class="wrap-input100 validate-input m-b-23" data-validate="Vui lòng nhập tên đăng nhập">
        <span class="label-input100">Email</span>
        <input class="input100" type="text" name="email" placeholder="Nhập tên đăng nhập">
        <span class="focus-input100" data-symbol="&#xf206;"></span>
    </div>

    <div class="wrap-input100 validate-input" data-validate="Vui lòng nhập mật khẩu">
        <span class="label-input100">Mật khẩu</span>
        <input class="input100" type="password" name="pass" placeholder="Nhập mật khẩu">
        <span class="focus-input100" data-symbol="&#xf190;"></span>
    </div>

    <div class="text-right p-t-8 p-b-31 d-flex justify-content-between mt-3">
        <a href="{{ route('register') }}" class="txt2">
            Đăng ký ngay
        </a>
        <a href="{{route('forgot')}}">
            Quên mật khẩu?
        </a>
    </div>
    

    <div class="container-login100-form-btn">
        <div class="wrap-login100-form-btn">
            <div class="login100-form-bgbtn"></div>
            <button class="login100-form-btn">
                Đăng nhập
            </button>
        </div>
    </div>
@endsection
