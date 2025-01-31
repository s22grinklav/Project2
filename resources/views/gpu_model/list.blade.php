@extends('layout')

@section('content')
<h1>{{ $title }}</h1>

@if (count($items) > 0)
    <table class="table table-sm table-hover table-striped">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Generation</th>
                <th>Architecture</th> <!-- Added Architecture Column -->
                <th>Base Clock</th>
                <th>Boost Clock</th>
                <th>CUDA Cores</th>
                <th>Memory Type</th>
                <th>VRAM</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $gpuModel)
                <tr>
                    <td>{{ $gpuModel->id }}</td>
                    <td>{{ $gpuModel->name }}</td>
                    <td>
                        <!-- Check if the generation relationship exists -->
                        @if ($gpuModel->generation)
                            {{ $gpuModel->generation->name }}
                        @else
                            No Generation
                        @endif
                    </td> 
                    <td>
                        <!-- Check if the architecture relationship exists -->
                        @if ($gpuModel->architecture)
                            {{ $gpuModel->architecture->name }}
                        @else
                            No Architecture
                        @endif
                    </td> <!-- Display Architecture -->
                    <td>{{ $gpuModel->base_clock }} MHz</td>
                    <td>{{ $gpuModel->boost_clock }} MHz</td>
                    <td>{{ $gpuModel->cuda_cores }}</td>
                    <td>{{ $gpuModel->memory_type }}</td>
                    <td>{{ $gpuModel->vram }} GB</td>
                    <td>
                        <a href="/gpu-models/update/{{ $gpuModel->id }}" class="btn btn-outline-primary btn-sm">Edit</a> /
                        <form method="post" action="/gpu-models/delete/{{ $gpuModel->id }}" class="d-inline deletion-form">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No GPU models found in the database.</p>
@endif

<a href="/gpu-models/create" class="btn btn-primary">Add New GPU Model</a>

@endsection
