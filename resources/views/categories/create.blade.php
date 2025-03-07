@extends('master')

@section('tilte')
    create
@endsection

@section('content')
    <h1 class="text-center m-5">Add New</h1>

    <form action="{{ route('categories.store') }}" method="post">
        @csrf

        <div class="m-3">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror">

            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="m-3">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
@endsection
