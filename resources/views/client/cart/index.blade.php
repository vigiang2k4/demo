@extends('client.layout.master')

@section('title')
    Cart
@endsection

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('home') }}">Trang Chủ</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Giỏ Hàng</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" method="post">
                    @csrf
                    <div class="site-blocks-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Hình Ảnh</th>
                                    <th class="product-name">Sản Phẩm</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product-quantity">Số Lượng</th>
                                    <th class="product-total">Tổng</th>
                                    <th class="product-remove">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cart->cartItems ?? [] as $item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <img src="{{ asset('storage/' . ($item->variant->avatar ?? '')) }}"
                                                alt="Image" class="img-fluid" style="max-height: 80px;">
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">
                                                {{ $item->variant->product->name ?? 'Unknown Product' }}
                                            </h2>
                                            <p class="small mb-0 text-muted">
                                                @if ($item->variant->color)
                                                    Màu: {{ $item->variant->color->name }}
                                                @endif
                                                @if ($item->variant->size)
                                                    | Size: {{ $item->variant->size->name }}
                                                @endif
                                            </p>
                                        </td>
                                        <td>{{ number_format($item->variant->price, 0) }} VND</td>
                                        <td>
                                            <form action="{{ route('cart.update', $item->variant_id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="input-group mb-3" style="max-width: 120px;">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-primary btn-decrease"
                                                            type="button">−</button>
                                                    </div>
                                                    <input type="text" name="quantity"
                                                        class="form-control text-center quantity-input"
                                                        value="{{ $item->quantity }}" min="1">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-primary btn-increase"
                                                            type="button">+</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                        <td>{{ number_format($item->total, 0) }} VND</td>
                                        <td>
                                            <form action="{{ route('cart.destroy', $item->variant_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-primary btn-sm">X</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Giỏ hàng trống</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <a href="{{ route('carts.index') }}" class="btn btn-primary btn-sm btn-block">Cập Nhật</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm btn-block">Tiếp Tục Mua Sắm</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Tổng Cộng</h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Tạm Tính</span>
                                </div>
                                <div class="col-md-6 text-right">
                                  <strong class="text-black">
                                    {{ number_format($cart->cartItems->isEmpty() ? 0 : $cart->cartItems->sum('total'), 0) }} VND
                                </strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Tổng Cộng</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">{{ number_format($cart->cartItems->sum('total'), 0) }}
                                        VND</strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('checkout.index') }}"
                                        class="btn btn-primary btn-lg py-3 btn-block">Thanh Toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
