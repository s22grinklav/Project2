<?php

namespace App\Http\Controllers;

use App\Models\GpuGeneration;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware; // Import the HasMiddleware class

class GpuGenerationController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     *
     * @return array
     */
    public static function middleware(): array
    {
        return [
            'auth', // Apply the 'auth' middleware to all methods in this controller
        ];
    }

    // List GPU generations
    public function list(): View
    {
        $items = GpuGeneration::orderBy('name', 'asc')->get(); // Fetch all GPU generations sorted by name
        return view('gpu_generation.list', [
            'title' => 'GPU Generations',
            'items' => $items,
        ]);
    }

    // Show form to create a new GPU generation
    public function create(): View
    {
        return view('gpu_generation.form', [
            'title' => 'Add New GPU Generation',
            'gpuGeneration' => new GpuGeneration(),  // Empty GPUGeneration object for the form
        ]);
    }

    // Save new GPU generation
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $gpuGeneration = new GpuGeneration();
        $gpuGeneration->name = $validatedData['name'];
        $gpuGeneration->save();

        return redirect('/gpu-generations');
    }

    // Show form to edit an existing GPU generation
    public function update(GpuGeneration $gpuGeneration): View
    {
        return view('gpu_generation.form', [
            'title' => 'Edit GPU Generation',
            'gpuGeneration' => $gpuGeneration,  // Pass existing GPU generation to form
        ]);
    }

    // Update GPU generation details
    public function patch(GpuGeneration $gpuGeneration, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $gpuGeneration->name = $validatedData['name'];
        $gpuGeneration->save();

        return redirect('/gpu-generations');
    }

    // Delete GPU generation
    public function delete(GpuGeneration $gpuGeneration): RedirectResponse
    {
        $gpuGeneration->delete();

        return redirect('/gpu-generations')->with('status', 'GPU Generation deleted successfully');
    }
}
