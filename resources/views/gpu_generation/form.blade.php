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

    <form method="post" action="{{ $gpuGeneration->exists ? '/gpu-generations/patch/' . $gpuGeneration->id : '/gpu-generations/put' }}">
        @csrf
        <div class="mb-3">
            <label for="gpu-generation-name" class="form-label">Generation Name</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="gpu-generation-name"
                name="name"
                value="{{ old('name', $gpuGeneration->name) }}"
            >
            @error('name')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
