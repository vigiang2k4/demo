@extends('admin.layout.master')

@section('title', 'Chỉnh sửa sản phẩm')

@section('content')
    <h1 class="text-center m-5">Chỉnh sửa sản phẩm</h1>

    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Tên sản phẩm --}}
        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control">
        </div>

        {{-- Danh mục --}}
        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-select">
                <option value="">Chọn danh mục</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Ảnh đại diện sản phẩm --}}
        <div class="mb-3">
            <label class="form-label">Ảnh đại diện sản phẩm</label>
            <input type="file" name="avatar" class="form-control">
            @if ($product->avatar)
                <img src="{{ asset('storage/' . $product->avatar) }}" width="100px" height="60" class="mt-2">
            @endif
        </div>

        {{-- Bộ sưu tập ảnh --}}
        <div class="mb-3">
            <label class="form-label">Bộ sưu tập ảnh</label>
            <input type="file" name="image[]" class="form-control" multiple>
            <div class="mt-2 d-flex flex-wrap gap-2">
                @foreach ($product->images as $image)
                    <img src="{{ asset('storage/' . $image->image) }}" width="100" height="60"
                        class="rounded border p-1">
                @endforeach
            </div>
        </div>

        {{-- Mô tả --}}
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="5">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- Biến thể sản phẩm --}}
        <div id="variants-container">
            <label for="variants">Biến thể sản phẩm</label>
            @foreach ($product->variants as $index => $variant)
                <div class="variant-item d-flex gap-2 mb-2">
                    <!-- Chọn màu -->
                    <select name="variants[{{ $index }}][color_id]" class="form-select">
                        <option value="">Chọn màu</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}"
                                {{ ($variant->color_id ?? old("variants.$index.color_id")) == $color->id ? 'selected' : '' }}>
                                {{ $color->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Chọn size -->
                    <select name="variants[{{ $index }}][size_id]" class="form-select">
                        <option value="">Chọn size</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}"
                                {{ ($variant->size_id ?? old("variants.$index.size_id")) == $size->id ? 'selected' : '' }}>
                                {{ $size->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Số lượng -->
                    <input type="number" name="variants[{{ $index }}][quantity]" placeholder="Số lượng"
                        class="form-control" value="{{ old("variants.$index.quantity", $variant->quantity) }}">

                    <!-- Giá -->
                    <input type="number" name="variants[{{ $index }}][price]" placeholder="Giá"
                        class="form-control" value="{{ old("variants.$index.price", $variant->price) }}">

                    <!-- Ảnh đại diện biến thể -->
                    <input type="file" name="variants[{{ $index }}][avatar]" class="form-control">
                    @if ($variant->avatar)
                        <img src="{{ asset('storage/' . $variant->avatar) }}" width="50" height="50">
                    @endif
                </div>
            @endforeach

        </div>

        <button type="button" id="add-variant" class="btn btn-primary mt-3">Thêm biến thể</button>

        {{-- Nút submit --}}
        <div class="mt-4 text-center mb-5">
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>

    <script>
        document.getElementById('add-variant').addEventListener('click', function() {
            let index = document.querySelectorAll('.variant-item').length;
            let newVariant = `
                <div class="variant-item d-flex gap-2 mb-2">
                    <select name="variants[${index}][color_id]" class="form-select">
                        <option value="">Chọn màu</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>

                    <select name="variants[${index}][size_id]" class="form-select">
                        <option value="">Chọn size</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>

                    <input type="number" name="variants[${index}][quantity]" class="form-control" placeholder="Số lượng">
                    <input type="number" name="variants[${index}][price]" class="form-control" placeholder="Giá">
                    <input type="file" name="variants[${index}][avatar]" class="form-control">

                    <button type="button" class="badge badge-danger remove-variant">X</button>
                </div>`;

            document.getElementById('variants-container').insertAdjacentHTML('beforeend', newVariant);
        });
    </script>
@endsection
