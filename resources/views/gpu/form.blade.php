@extends('layout')

@section('content')
    <h1>{{ $title }}</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ $gpu->exists ? '/gpus/patch/' . $gpu->id : '/gpus/put' }}">
        @csrf
        <div class="mb-3">
            <label for="gpu-name" class="form-label">GPU Name</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="gpu-name"
                name="name"
                value="{{ old('name', $gpu->name) }}"
            >
            @error('name')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gpu-series" class="form-label">Series</label>
            <input
                type="number"
                class="form-control @error('series') is-invalid @enderror"
                id="gpu-series"
                name="series"
                value="{{ old('series', $gpu->series) }}"
            >
            @error('series')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gpu-vram" class="form-label">VRAM (GB)</label>
            <input
                type="number"
                class="form-control @error('vram') is-invalid @enderror"
                id="gpu-vram"
                name="vram"
                value="{{ old('vram', $gpu->vram) }}"
            >
            @error('vram')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="gpu-memory-type" class="form-label">Memory Type</label>
            <input
                type="text"
                class="form-control @error('memory_type') is-invalid @enderror"
                id="gpu-memory-type"
                name="memory_type"
                value="{{ old('memory_type', $gpu->memory_type) }}"
            >
            @error('memory_type')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="gpu-architecture" class="form-label">Architecture</label>
            <input
                type="text"
                class="form-control @error('architecture') is-invalid @enderror"
                id="gpu-architecture"
                name="architecture"
                value="{{ old('architecture', $gpu->architecture) }}"
            >
            @error('architecture')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gpu-base-clock" class="form-label">Base Clock (MHz)</label>
            <input
                type="number"
                class="form-control @error('base_clock') is-invalid @enderror"
                id="gpu-base-clock"
                name="base_clock"
                value="{{ old('base_clock', $gpu->base_clock) }}"
            >
            @error('base_clock')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gpu-boost-clock" class="form-label">Boost Clock (MHz)</label>
            <input
                type="number"
                class="form-control @error('boost_clock') is-invalid @enderror"
                id="gpu-boost-clock"
                name="boost_clock"
                value="{{ old('boost_clock', $gpu->boost_clock) }}"
            >
            @error('boost_clock')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gpu-cuda-cores" class="form-label">CUDA Cores</label>
            <input
                type="number"
                class="form-control @error('cuda_cores') is-invalid @enderror"
                id="gpu-cuda-cores"
                name="cuda_cores"
                value="{{ old('cuda_cores', $gpu->cuda_cores) }}"
            >
            @error('cuda_cores')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
