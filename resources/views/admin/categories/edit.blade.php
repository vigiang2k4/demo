@extends('admin.layout.master')

@section('title')
    Chỉnh sửa danh mục
@endsection

@section('content')
    <h1 class="text-center m-5">Chỉnh sửa danh mục</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="m-3">
            <label for="name">Tên danh mục</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" 
                class="form-control mt-3 @error('name') is-invalid @enderror">
            
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="m-3">
            <label for="avatar">Hình ảnh hiện tại</label>
            <div class="mb-3">
                <img src="{{ asset('storage/' . $category->avatar) }}" width="150" alt="Category Image">
            </div>
            <input type="file" name="avatar" class="form-control mt-3">
            @if ($errors->has('avatar'))
                <span class="text-danger">{{ $errors->first('avatar') }}</span>
            @endif
        </div>

        <div class="m-3 mt-5 text-center">
            <button type="submit" class="btn btn-primary m-3">Cập nhật</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
@endsection
