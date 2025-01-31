@extends('layout')

@section('content')
<h1>{{ $title }}</h1>

<form method="POST" action="{{ isset($gpuArchitecture) ? route('gpu-architectures.update', $gpuArchitecture) : route('gpu-architectures.store') }}">
    @csrf
    @if(isset($gpuArchitecture))
        @method('PATCH')
    @endif

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $gpuArchitecture->name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description">{{ old('description', $gpuArchitecture->description ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ isset($gpuArchitecture) ? 'Update' : 'Create' }}
    </button>
</form>

@endsection
