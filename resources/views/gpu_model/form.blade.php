@extends('layout')

@section('content')
<h1>{{ $title }}</h1>

<!-- Show general error message if there are validation errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Please fix the validation errors!</strong>
    </div>
@endif

<!-- Form for creating or updating GPU model -->
<form method="post" action="{{ $gpuModel->exists ? '/gpu-models/patch/' . $gpuModel->id : '/gpu-models/put' }}" enctype="multipart/form-data">
    @csrf

    <!-- Name Field -->
    <div class="mb-3">
        <label for="gpu-model-name" class="form-label">Name</label>
        <input
            type="text"
            id="gpu-model-name"
            name="name"
            value="{{ old('name', $gpuModel->name) }}"
            class="form-control @error('name') is-invalid @enderror"
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Generation Field -->
    <div class="mb-3">
        <label for="gpu-model-generation" class="form-label">Generation</label>
        <select
            id="gpu-model-generation"
            name="generation_id"
            class="form-select @error('generation_id') is-invalid @enderror"
        >
            <option value="">Choose the generation!</option>
            @foreach($generations as $generation)
                <option
                    value="{{ $generation->id }}"
                    @if ($generation->id == old('generation_id', $gpuModel->generation->id ?? false)) selected @endif
                >
                    {{ $generation->name }}
                </option>
            @endforeach
        </select>
        @error('generation_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- GPU Architecture Field -->
    <div class="mb-3">
        <label for="gpu-model-architecture" class="form-label">Architecture</label>
        <select
            id="gpu-model-architecture"
            name="gpu_architecture_id"
            class="form-select @error('gpu_architecture_id') is-invalid @enderror"
        >
            <option value="">Choose the architecture!</option>
            @foreach($architectures as $architecture)
                <option
                    value="{{ $architecture->id }}"
                    @if ($architecture->id == old('gpu_architecture_id', $gpuModel->gpu_architecture_id ?? false)) selected @endif
                >
                    {{ $architecture->name }}
                </option>
            @endforeach
        </select>
        @error('gpu_architecture_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Base Clock Field -->
    <div class="mb-3">
        <label for="gpu-model-base-clock" class="form-label">Base Clock (MHz)</label>
        <input
            type="number"
            id="gpu-model-base-clock"
            name="base_clock"
            value="{{ old('base_clock', $gpuModel->base_clock) }}"
            class="form-control @error('base_clock') is-invalid @enderror"
        >
        @error('base_clock')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Boost Clock Field -->
    <div class="mb-3">
        <label for="gpu-model-boost-clock" class="form-label">Boost Clock (MHz)</label>
        <input
            type="number"
            id="gpu-model-boost-clock"
            name="boost_clock"
            value="{{ old('boost_clock', $gpuModel->boost_clock) }}"
            class="form-control @error('boost_clock') is-invalid @enderror"
        >
        @error('boost_clock')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- VRAM Field -->
    <div class="mb-3">
        <label for="gpu-model-vram" class="form-label">VRAM (GB)</label>
        <input
            type="number"
            id="gpu-model-vram"
            name="vram"
            value="{{ old('vram', $gpuModel->vram) }}"
            class="form-control @error('vram') is-invalid @enderror"
        >
        @error('vram')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Memory Type Field -->
    <div class="mb-3">
        <label for="gpu-model-memory-type" class="form-label">Memory Type</label>
        <input
            type="text"
            id="gpu-model-memory-type"
            name="memory_type"
            value="{{ old('memory_type', $gpuModel->memory_type) }}"
            class="form-control @error('memory_type') is-invalid @enderror"
        >
        @error('memory_type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- CUDA Cores Field -->
    <div class="mb-3">
        <label for="gpu-model-cuda-cores" class="form-label">CUDA Cores</label>
        <input
            type="number"
            id="gpu-model-cuda-cores"
            name="cuda_cores"
            value="{{ old('cuda_cores', $gpuModel->cuda_cores) }}"
            class="form-control @error('cuda_cores') is-invalid @enderror"
        >
        @error('cuda_cores')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Image Upload Field -->
    <div class="mb-3">
        <label for="gpu-model-image" class="form-label">Image</label>
        <!-- Display existing image if it exists -->
        @if ($gpuModel->image)
            <img src="{{ asset('images/' . $gpuModel->image) }}" class="img-fluid img-thumbnail d-block mb-2" alt="{{ $gpuModel->name }}">
        @endif

        <!-- File input for new image upload -->
        <input
            type="file"
            id="gpu-model-image"
            name="image"
            accept="image/png, image/webp, image/jpeg"
            class="form-control @error('image') is-invalid @enderror"
        >

        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">
        {{ $gpuModel->exists ? 'Update' : 'Create' }}
    </button>
</form>

@endsection
