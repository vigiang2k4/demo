@extends('admin.layout.master')

@section('title')
    Dashboard
@endsection

@section('content')
    aaaa
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Đăng xuất</button>
    </form>
@endsection
