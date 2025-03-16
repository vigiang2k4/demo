@extends('master')

@section('tilte')
    create
@endsection

@section('content')
    <h1 class="mt-5 text-center">Categories</h1> 
    <a href="{{route('categories.create')}}" class="btn btn-success mt-5">New</a>

    <table class="table m-5" border="1">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
          <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('oke')">Delete</button>
                </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <!-- Hiển thị phân trang -->
      {{ $categories->links() }}
@endsection