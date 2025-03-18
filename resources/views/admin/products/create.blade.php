@extends('admin.layout.master')

@section('title', 'Thêm sản phẩm')

@section('content')
    <h1 class="text-center m-5">Thêm mới sản phẩm</h1>

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="m-3">
            <label for="name">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="m-3">
            <label for="category_id">Danh mục</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="m-3">
            <label for="avatar">Hình ảnh</label>
            <input type="file" name="avartar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success m-3">Thêm</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
