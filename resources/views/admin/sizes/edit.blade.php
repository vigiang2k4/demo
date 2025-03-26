@extends('admin.layout.master')

@section('title')
    Chỉnh sửa kích cỡ
@endsection

@section('content')
    <h1 class="text-center m-5">Chỉnh sửa Kích cỡ</h1>

    <form action="{{ route('sizes.update', $size->id) }}" method="post">
        @csrf
        @method('PUT') {{-- Laravel yêu cầu PUT khi cập nhật --}}

        <div class="m-3">
            <label for="name">Tên</label>
            <input type="text" name="name" value="{{ old('name', $size->name) }}"
                class="form-control mt-3 mb-3 @error('name') is-invalid @enderror">

            @error('name')
                <div class="text-danger mt-3">{{ $message }}</div>
            @enderror
        </div>

        <div class="m-3 mt-5 text-center">
            <button type="submit" class="btn btn-primary m-3">Cập nhật</button>
            <a href="{{ route('sizes.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
@endsection
