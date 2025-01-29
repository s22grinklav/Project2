<?php

namespace App\Http\Controllers;

use App\Models\Gpu;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware; // Import the HasMiddleware class

class GpuController extends Controller implements HasMiddleware
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

    // List GPUs
    public function list(): View
    {
        $items = Gpu::orderBy('name', 'asc')->get(); // Fetch all GPUs sorted by name
        return view('gpu.list', [
            'title' => 'GPUs',
            'items' => $items,
        ]);
    }

    // Show form to create a new GPU
    public function create(): View
    {
        return view('gpu.form', [
            'title' => 'Add New GPU',
            'gpu' => new Gpu(),  // Empty GPU object for the form
        ]);
    }

    // Save new GPU
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'series' => 'required|integer',
            'vram' => 'required|integer',
            'architecture' => 'required|string|max:255',
            'base_clock' => 'required|numeric',
            'boost_clock' => 'required|numeric',
            'cuda_cores' => 'required|integer',
            'memory_type' => 'required|string|max:255',
        ]);

        $gpu = new Gpu();
        $gpu->name = $validatedData['name'];
        $gpu->series = $validatedData['series'];
        $gpu->vram = $validatedData['vram'];
        $gpu->architecture = $validatedData['architecture'];
        $gpu->base_clock = $validatedData['base_clock'];
        $gpu->boost_clock = $validatedData['boost_clock'];
        $gpu->cuda_cores = $validatedData['cuda_cores'];
        $gpu->memory_type = $validatedData['memory_type'];
        $gpu->save();

        return redirect('/gpus');
    }

    // Show form to edit an existing GPU
    public function update(Gpu $gpu): View
    {
        return view('gpu.form', [
            'title' => 'Edit GPU',
            'gpu' => $gpu,  // Pass existing GPU to form
        ]);
    }

    // Update GPU details
    public function patch(Gpu $gpu, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'series' => 'required|integer',
            'vram' => 'required|integer',
            'architecture' => 'required|string|max:255',
            'base_clock' => 'required|numeric',
            'boost_clock' => 'required|numeric',
            'cuda_cores' => 'required|integer',
            'memory_type' => 'required|string|max:255',
        ]);

        $gpu->name = $validatedData['name'];
        $gpu->series = $validatedData['series'];
        $gpu->vram = $validatedData['vram'];
        $gpu->architecture = $validatedData['architecture'];
        $gpu->base_clock = $validatedData['base_clock'];
        $gpu->boost_clock = $validatedData['boost_clock'];
        $gpu->cuda_cores = $validatedData['cuda_cores'];
        $gpu->memory_type = $validatedData['memory_type'];
        $gpu->save();

        return redirect('/gpus');
    }

    // Delete GPU
    public function delete(Gpu $gpu): RedirectResponse
    {
        // Optionally, you can add additional logic here to check if there are related records
        // that might prevent deletion (e.g., if there are associated books, reviews, etc.)

        // Delete the GPU
        $gpu->delete();

        // Redirect back to the GPU list
        return redirect('/gpus')->with('status', 'GPU deleted successfully');
    }
}
