@extends('admin.layout.master')

@section('title', 'Danh sách sản phẩm')

@section('content')

    <div class="container mt-4">
        <h1 class="text-center mb-4">Danh sách sản phẩm</h1>

        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Thêm sản phẩm
        </a>

        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Danh mục</th>
                        <th>Ảnh</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td><strong>{{ $product->id }}</strong></td>
                            <td>{{ $product->name }}</td>
                            <td><span class="badge bg-success">{{ $product->category->name }}</span></td>
                            <td>
                                @if ($product->avatar)
                                    <img src="{{ asset('storage/' . $product->avatar) }}" class="img-thumbnail"
                                        width="60">
                                @else
                                    <span class="text-muted">Không có ảnh</span>
                                @endif
                            </td>
                            <td class="text-truncate" style="max-width: 200px;">{{ $product->description }}</td>
                            <td>
                                @if ($product->status == 1)
                                    <span class="badge bg-success">Hiện</span>
                                @else
                                    <span class="badge bg-danger">Ẩn</span>
                                @endif
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
