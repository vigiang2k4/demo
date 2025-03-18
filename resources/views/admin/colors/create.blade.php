@extends('admin.layout.master')

@section('tilte')
    Thêm mới màu sắc 
@endsection

@section('content')
    <h1 class="text-center m-5">Thêm mới màu sắc</h1>

    <form action="{{ route('colors.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="m-3">
            <label for="name">Tên </label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="form-control mt-3 mb-3  @error('name') is-invalid @enderror">

            @error('name')
                <div class="text-danger mt-3 ">{{ $message }}</div>
            @enderror
        </div>

        <div class="m-3 mt-5 text-center">
            <button type="submit" class="btn btn-success m-3">Thêm mới </button>
            <a href="{{ route('colors.index') }}" class="btn btn-secondary">Quay lại </a>
        </div>
    </form>
@endsection
