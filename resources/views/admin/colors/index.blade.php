@extends('admin.layout.master')

@section('tilte')
    Danh sách màu sắc 
@endsection

@section('content')
    <h1 class="mt-5 text-center">Màu sắc </h1>

    <div class="">
        <a href="{{ route('colors.create') }}" class="btn btn-success mt-5">Thêm mới</a>
    </div>

    <table class="table m-5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($colors as $color)
                <tr>
                    <td>{{ $color->id }}</td>
                    <td>{{ $color->name }}</td>
                    <td class="d-flex">
                        <a href="{{ route('colors.edit', $color->id) }}" class="btn btn-secondary m-3">Sửa</a>
                        <form action="{{ route('colors.destroy', $color->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger m-3" onclick="return confirm('oke')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Hiển thị phân trang -->
    {{ $colors->links() }}
@endsection
