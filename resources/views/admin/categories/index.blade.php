@extends('admin.layout.master')

@section('tilte')
    Danh sách danh mục 
@endsection

@section('content')
    <h1 class="mt-5 text-center">Danh mục</h1>

    <div class="">
        <a href="{{ route('categories.create') }}" class="btn btn-success mt-5">Thêm mới </a>
    </div>

    <table class="table m-5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Hình ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $category->avatar) }}" width="100" alt="Ảnh danh mục">
                    </td>
                    <td class="d-flex">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-secondary m-3">Sửa</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
    {{ $categories->links() }}
@endsection
