<?php

namespace App\Http\Controllers;

use App\Models\GpuArchitecture;
use App\Http\Requests\GpuArchitectureRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GpuArchitectureController extends Controller
{
    // List all GPU architectures
    public function list(): View
    {
        $architectures = GpuArchitecture::all();
        return view('gpu_architecture.list', [
            'title' => 'GPU Architectures',
            'architectures' => $architectures
        ]);
    }

    // Show form to create a new GPU architecture
    public function create(): View
    {
        return view('gpu_architecture.form', [
            'title' => 'Create New GPU Architecture'
        ]);
    }

    // Store a new GPU architecture
    public function store(GpuArchitectureRequest $request): RedirectResponse
    {
        GpuArchitecture::create($request->validated());
        return redirect()->route('gpu-architectures.list')->with('success', 'GPU Architecture created successfully!');
    }

    // Show form to edit an existing GPU architecture
    public function edit(GpuArchitecture $gpuArchitecture): View
    {
        return view('gpu_architecture.form', [
            'title' => 'Edit GPU Architecture',
            'gpuArchitecture' => $gpuArchitecture
        ]);
    }

    // Update the GPU architecture
    public function update(GpuArchitectureRequest $request, GpuArchitecture $gpuArchitecture): RedirectResponse
    {
        $gpuArchitecture->update($request->validated());
        return redirect()->route('gpu-architectures.list')->with('success', 'GPU Architecture updated successfully!');
    }

    // Delete a GPU architecture
    public function destroy(GpuArchitecture $gpuArchitecture): RedirectResponse
    {
        $gpuArchitecture->delete();
        return redirect()->route('gpu-architectures.list')->with('success', 'GPU Architecture deleted successfully!');
    }
}
