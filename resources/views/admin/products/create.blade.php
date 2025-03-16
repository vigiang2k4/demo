@extends('master')

@section('tilte')
    create
@endsection

@section('content')
    <h1 class="text-center m-5">Thêm sản phẩm mới</h1>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Hình ảnh</label>
            <input type="text" name="avartar" value="{{ old('avartar') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" name="price" value="{{ old('price') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Số lượng</label>
            <input type="number" name="quantity" value="{{ old('quantity') }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Thêm mới</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
