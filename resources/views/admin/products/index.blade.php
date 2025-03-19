@extends('admin.layout.master')

@section('title', 'Danh sách sản phẩm')

@section('content')

    <h1 class="text-center m-5">Danh sách sản phẩm</h1>
    
    <a href="{{ route('products.create') }}" class="btn btn-primary m-3">Thêm sản phẩm</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Danh mục</th>
                <th>Ảnh</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td><img src="{{ asset('storage/' . $product->avartar) }}" width="50"></td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
