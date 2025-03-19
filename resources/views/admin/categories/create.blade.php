@extends('admin.layout.master')

@section('tilte')
    Thêm mới danh mục 
@endsection

@section('content')
    <h1 class="text-center m-5">Thêm mới danh mục </h1>

    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="m-3">
            <label for="name">Tên </label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="form-control mt-3  @error('name') is-invalid @enderror">

            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="m-3">
            <label for="name">Hình ảnh </label>
            <input type="file" name="avatar" id="" class="form-control mt-3">
            @if ($errors->has('avatar'))
                <span class="text-danger">{{ $errors->first('avatar') }}</span>
            @endif
        </div>

        <div class="m-3 mt-5 text-center">
            <button type="submit" class="btn btn-success m-3">Thêm mới </button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại </a>
        </div>
    </form>
@endsection
