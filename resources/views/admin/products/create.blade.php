@extends('admin.layout.master')

@section('title', 'Thêm sản phẩm')

@section('content')
    <h1 class="text-center m-5">Thêm Mới Sản Phẩm</h1>

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        {{-- Tên sản phẩm --}}
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Danh mục --}}
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">Chọn danh mục</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Ảnh đại diện sản phẩm --}}
        <div class="mb-3">
            <label class="form-label">Ảnh đại diện sản phẩm</label>
            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
            @error('avatar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Bộ sưu tập ảnh --}}
        <div class="mb-3">
            <label class="form-label">Bộ sưu tập ảnh</label>
            <input type="file" name="image[]" class="form-control" multiple>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea type="text" name="description" class="form-control" rows="20">{{ old('description') }}</textarea>
        </div>

        {{-- Biến thể sản phẩm --}}
        <div id="variants-container">
            <label for="variants">Biến thể sản phẩm</label>
            <div class="variant-item d-flex gap-2 mb-2">
                <!-- Chọn màu -->
                <select name="variants[0][color_id]" class="form-select @error('variants.0.color_id') is-invalid @enderror">
                    <option value="">Chọn màu</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}"
                            {{ old('variants.0.color_id') == $color->id ? 'selected' : '' }}>
                            {{ $color->name }}
                        </option>
                    @endforeach
                </select>
                @error('variants.0.color_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <!-- Chọn size -->
                <select name="variants[0][size_id]" class="form-select @error('variants.0.size_id') is-invalid @enderror">
                    <option value="">Chọn size</option>
                    @foreach ($sizes as $size)
                        <option value="{{ $size->id }}"
                            {{ old('variants.0.size_id') == $size->id ? 'selected' : '' }}>
                            {{ $size->name }}
                        </option>
                    @endforeach
                </select>
                @error('variants.0.size_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <!-- Số lượng -->
                <input type="number" name="variants[0][quantity]" placeholder="Số lượng"
                    class="form-control @error('variants.0.quantity') is-invalid @enderror"
                    value="{{ old('variants.0.quantity') }}">
                @error('variants.0.quantity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                       <!-- price -->
                <input type="number" name="variants[0][price]" placeholder="Giá"
                    class="form-control @error('variants.0.price') is-invalid @enderror"
                    value="{{ old('variants.0.price') }}">
                @error('variants.0.price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror


                <!-- Ảnh đại diện biến thể -->
                <input type="file" name="variants[0][avatar]"
                    class="form-control @error('variants.0.avatar') is-invalid @enderror">
                @error('variants.0.avatar')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <button type="button" class="badge badge-danger remove-variant">X</button>
            </div>
        </div>
        <div class="m-3">
            @error('variants')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="button" id="add-variant" class="btn btn-primary">Thêm biến thể</button>

        {{-- Trạng thái sản phẩm --}}
        <div class="mb-3 mt-4">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" class="form-select @error('status') is-invalid @enderror">
                <option value="1" selected>Hiện</option>
                <option value="0">Ẩn</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nút submit --}}
        <div class="mt-4 text-center mb-5">
            <button type="submit" class="btn btn-success">Thêm mới</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>

    {{-- Script thêm/xóa biến thể --}}
    <script>
        document.getElementById('add-variant').addEventListener('click', function() {
            let index = document.querySelectorAll('.variant-item').length;
            let newVariant = `
                <div class="variant-item d-flex gap-2 mb-2">
                    <select name="variants[${index}][color_id]" class="form-select @error('variants.${index}.color_id') is-invalid @enderror">
                        <option value="">Chọn màu</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                    @error('variants.${index}.color_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <select name="variants[${index}][size_id]" class="form-select @error('variants.${index}.size_id') is-invalid @enderror">
                        <option value="">Chọn size</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                    @error('variants.${index}.size_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <input type="number" name="variants[${index}][quantity]" placeholder="Số lượng" class="form-control @error('variants.${index}.quantity') is-invalid @enderror">
                    @error('variants.${index}.quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                     <input type="number" name="variants[${index}][price]" placeholder="price" class="form-control @error('variants.${index}.price') is-invalid @enderror">
                    @error('variants.${index}.price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <input type="file" name="variants[${index}][avatar]" class="form-control @error('variants.${index}.avatar') is-invalid @enderror">
                    @error('variants.${index}.avatar')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <button type="button" class="badge badge-danger remove-variant">X</button>
                </div>`;

            document.getElementById('variants-container').insertAdjacentHTML('beforeend', newVariant);
        });
    </script>
@endsection
