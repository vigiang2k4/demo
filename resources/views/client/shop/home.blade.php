@extends('client.layout.master')

@section('title')
    Home
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>New update Products</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nonloop-block-3 owl-carousel">
                    @foreach ($products as $product)
                        <div class="item">
                            <div class="block-4 text-center">
                                <a href="{{ route('detail', $product->id) }}">
                                    <figure class="block-4-image">
                                        <img src="{{ asset('storage/' . $product->avatar) }}" alt="{{ $product->name }}" 
                                            width="200" height="150" class="img-fluid" style="object-fit: cover;">
                                    </figure>
                                </a>
                                <div class="block-4-text p-4">
                                    <h3><a href="{{ route('detail', $product->id) }}">{{ $product->name }}</a></h3>
                                    <p class="mb-0">{{ Str::limit($product->description, 50) }}</p>
                                    @if ($product->cheapest_variant)
                                        <p class="text-primary font-weight-bold">
                                            {{ number_format($product->cheapest_variant->price) }} VND
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
@endsection
