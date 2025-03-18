@extends('admin.layout.master')

@section('tilte')
    Danh sách kích cỡ 
@endsection

@section('content')
    <h1 class="mt-5 text-center">Kích cỡ</h1>

    <div class="">
        <a href="{{ route('sizes.create') }}" class="btn btn-success mt-5">Thêm mới</a>
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
            @foreach ($sizes as $size)
                <tr>
                    <td>{{ $size->id }}</td>
                    <td>{{ $size->name }}</td>
                    <td class="d-flex">
                        <a href="{{ route('sizes.edit', $size->id) }}" class="btn btn-secondary m-3">Sửa</a>
                        <form action="{{ route('sizes.destroy', $size->id) }}" method="POST">
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
    {{ $sizes->links() }}
@endsection
