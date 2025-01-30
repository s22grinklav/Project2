@extends('layout')

@section('content')
<h1>{{ $title }}</h1>

@if (count($items) > 0)
    <table class="table table-striped table-hover table-sm">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Generation Name</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $generation)
                <tr>
                    <td>{{ $generation->id }}</td>
                    <td>{{ $generation->name }}</td>
                    <td>
                        <!-- Edit Link -->
                        <a href="/gpu-generations/update/{{ $generation->id }}" class="btn btn-outline-primary btn-sm">Edit</a>

                        <!-- Delete Form -->
                        <form action="/gpu-generations/delete/{{ $generation->id }}" method="post" class="deletion-form d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No GPU generations found in the database.</p>
@endif

<!-- Link to create a new GPU generation -->
<a href="/gpu-generations/create" class="btn btn-primary">Add New GPU Generation</a>
@endsection
