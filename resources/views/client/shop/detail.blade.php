@extends('client.layout.master')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('home') }}">Home</a> <span class="mx-2">/</span>
                    <a href="#">{{ $product->category->name }}</a> <span class="mx-2">/</span>
                    <strong class="text-black">{{ $product->name }}</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <!-- Hình ảnh sản phẩm -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <img id="product-avatar" src="{{ asset('storage/' . $product->avatar) }}" alt="{{ $product->name }}"
                            class="img-fluid" style="max-height: 400px; width: 100%; object-fit: cover;">
                    </div>

                    <!-- Bộ sưu tập hình ảnh -->
                    <div class="d-flex flex-wrap">
                        <img class="small-image mr-2 mb-2" src="{{ asset('storage/' . $product->avatar) }}" alt="Main Image"
                            width="100" height="60" style="object-fit: cover; cursor: pointer;">
                        @foreach ($product->images as $image)
                            <img src="{{ asset('storage/' . $image->image) }}" width="100" height="60"
                                class="rounded border p-1">
                        @endforeach
                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="col-md-6">
                    <h2 class="text-black">{{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>

                    <!-- Danh sách biến thể theo cặp (Size - Màu) -->
                    <div class="mb-3">
                        <label>Chọn biến thể:</label>
                        <div class="d-flex flex-wrap">
                            @foreach ($product->variants as $variant)
                                <button class="btn btn-outline-dark variant-btn mr-2 mb-2"
                                    data-avatar="{{ asset('storage/' . $variant->avatar) }}"
                                    data-price="{{ number_format($variant->price, 2) }} VND">
                                    {{ $variant->size->name }} - {{ $variant->color->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Hiển thị giá -->
                    <p><strong class="text-primary h4" id="product-price">
                            {{ number_format($product->variants->first()->price, 2) }} VND
                        </strong></p>

                    <!-- Số lượng -->
                    <div class="mb-4">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="text" class="form-control text-center" value="1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                        </div>
                    </div>

                    <p><a href="#" class="buy-now btn btn-sm btn-primary">Add To Cart</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sản phẩm liên quan -->
    <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Related Products</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel">
                        @foreach ($relatedProducts as $related)
                            <div class="item">
                                <div class="block-4 text-center">
                                    <figure class="block-4-image">
                                        <a href="{{ route('detail', $related->id) }}">
                                            <img src="{{ asset('storage/' . $related->avatar) }}"
                                                alt="{{ $related->name }}" class="img-fluid"
                                                style="height: 150px; width: 100%; object-fit: cover;">
                                        </a>
                                    </figure>
                                    <div class="block-4-text p-4">
                                        <h3><a href="{{ route('detail', $related->id) }}">{{ $related->name }}</a></h3>
                                        <p class="mb-0">{{ Str::limit($related->description, 50) }}</p>
                                        @if ($related->variants->count() > 0)
                                            <p class="text-primary font-weight-bold">
                                                {{ number_format($related->variants->first()->price, 2) }} VND
                                            </p>
                                        @else
                                            <p class="text-secondary">Chưa có giá</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const variantButtons = document.querySelectorAll('.variant-btn');
            const productAvatar = document.getElementById('product-avatar');
            const productPrice = document.getElementById('product-price');
            const smallImages = document.querySelectorAll('.small-image');

            // Sự kiện thay đổi avatar & giá khi chọn biến thể
            variantButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const newAvatar = this.getAttribute('data-avatar');
                    const newPrice = this.getAttribute('data-price');

                    productAvatar.src = newAvatar;
                    productPrice.textContent = newPrice;
                });
            });

            // Sự kiện thay đổi avatar khi chọn ảnh từ bộ sưu tập
            smallImages.forEach(image => {
                image.addEventListener('click', function() {
                    productAvatar.src = this.src;
                });
            });
        });
    </script>
@endsection
