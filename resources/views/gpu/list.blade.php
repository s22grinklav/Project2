@extends('layout')

@section('content')
<h1>{{ $title }}</h1>

@if (count($items) > 0)
    <table class="table table-striped table-hover table-sm">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Series</th>
                <th>VRAM (GB)</th>
                <th>Architecture</th>
                <th>Base Clock (MHz)</th>
                <th>Boost Clock (MHz)</th>
                <th>CUDA Cores</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $gpu)
                <tr>
                    <td>{{ $gpu->id }}</td>
                    <td>{{ $gpu->name }}</td>
                    <td>{{ $gpu->series }}</td>
                    <td>{{ $gpu->vram }}</td>
                    <td>{{ $gpu->architecture }}</td>
                    <td>{{ $gpu->base_clock }}</td>
                    <td>{{ $gpu->boost_clock }}</td>
                    <td>{{ $gpu->cuda_cores }}</td>
                    <td>
                        <!-- Edit Link -->
                        <a href="/gpus/update/{{ $gpu->id }}" class="btn btn-outline-primary btn-sm">Edit</a>

                        <!-- Delete Form -->
                        <form action="/gpus/delete/{{ $gpu->id }}" method="post" class="deletion-form d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No entries found in the database</p>
@endif

<!-- Link to create a new GPU -->
<a href="/gpus/create" class="btn btn-primary">Add New GPU</a>
@endsection
