@extends('layout')

@section('content')
<h1>GPU Architectures</h1>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('gpu-architectures.create') }}" class="btn btn-primary mb-3">Create New Architecture</a>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($architectures as $architecture)
            <tr>
                <td>{{ $architecture->name }}</td>
                <td>{{ $architecture->description }}</td>
                <td>
                    <a href="{{ route('gpu-architectures.edit', $architecture) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('gpu-architectures.delete', $architecture) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
