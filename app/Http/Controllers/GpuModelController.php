<?php

namespace App\Http\Controllers;

use App\Models\GpuModel;
use App\Models\GpuGeneration;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class GpuModelController extends Controller implements HasMiddleware
{
    // Enforcing auth middleware for the controller
    public static function middleware(): array
    {
        return [
            'auth',  // Ensure the user is authenticated
        ];
    }

    // List all GPU Models (view method)
    public function list(): View
    {
        // Fetch all GPU models in ascending order by name
        $items = GpuModel::orderBy('name', 'asc')->get();

        // Return the 'gpu_model.list' view with title and items data
        return view(
            'gpu_model.list', 
            [
                'title' => 'GPU Models',  // Title of the page
                'items' => $items         // GPU models data
            ]
        );
    }

    // Show form to create a new GPU model
    public function create(): View
    {
        // Retrieve all GPU generations for selection
        $generations = GpuGeneration::all();

        // Create a new empty instance of GpuModel for the creation form
        $gpuModel = new GpuModel();

        // Return the view for creating a new GPU model with title
        return view('gpu_model.form', [
            'title' => 'Create New GPU Model', // Add the title here
            'gpuModel' => $gpuModel,           // Pass the empty GPU model instance
            'generations' => $generations // Pass the generations for selection
        ]);
    }

    // Store a new GPU model in the database
    public function put(Request $request): RedirectResponse
    {
        // Validate the input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'generation_id' => 'required|exists:gpu_generations,id',
            'base_clock' => 'required|integer',
            'boost_clock' => 'required|integer',
            'cuda_cores' => 'required|integer',
            'memory_type' => 'required|string',
            'vram' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240', // Image validation
        ]);

        // Create a new GPU model
        $gpuModel = GpuModel::create([
            'name' => $validated['name'],
            'generation_id' => $validated['generation_id'],
            'base_clock' => $validated['base_clock'],
            'boost_clock' => $validated['boost_clock'],
            'cuda_cores' => $validated['cuda_cores'],
            'memory_type' => $validated['memory_type'],
            'vram' => $validated['vram'],
        ]);

        // Handle image upload if the image is present
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->getClientOriginalExtension();
            $name = uniqid();
            
            // Save the image in the 'uploads' disk
            $gpuModel->image = $uploadedFile->storePubliclyAs(
                '/',
                $name . '.' . $extension,
                'uploads'  // This uses the 'uploads' disk from config/filesystems.php
            );
            
            $gpuModel->save(); // Save the model after setting the image path
        }

        // Redirect back to the GPU models list with success message
        return redirect('/gpu-models')->with('success', 'GPU Model created successfully!');
    }

    // Show the form to update an existing GPU model
    public function update(GpuModel $gpuModel): View
    {
        // Retrieve all GPU generations for selection
        $gpuGenerations = GpuGeneration::all();

        // Return the view for updating the GPU model with title
        return view('gpu_model.form', [
            'title' => 'Edit GPU Model',  // Title for editing
            'gpuModel' => $gpuModel,      // Pass the GPU model instance
            'generations' => $gpuGenerations // Pass the generations for selection
        ]);
    }

    // Update the GPU model in the database
    public function patch(Request $request, GpuModel $gpuModel): RedirectResponse
    {
        // Validate the input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'generation_id' => 'required|exists:gpu_generations,id',
            'base_clock' => 'required|integer',
            'boost_clock' => 'required|integer',
            'cuda_cores' => 'required|integer',
            'memory_type' => 'required|string',
            'vram' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240', // Image validation
        ]);

        // Update the GPU model with the new data
        $gpuModel->update([
            'name' => $validated['name'],
            'generation_id' => $validated['generation_id'],
            'base_clock' => $validated['base_clock'],
            'boost_clock' => $validated['boost_clock'],
            'cuda_cores' => $validated['cuda_cores'],
            'memory_type' => $validated['memory_type'],
            'vram' => $validated['vram'],
        ]);

        // If an image is uploaded, replace the old one and save the new one
        if ($request->hasFile('image')) {
            // Delete the old image file if exists
            if ($gpuModel->image) {
                unlink(public_path('images/' . $gpuModel->image));
            }

            // Handle the new uploaded image
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->getClientOriginalExtension();
            $name = uniqid();

            // Save the new image in the 'uploads' directory
            $gpuModel->image = $uploadedFile->storePubliclyAs(
                '/',
                $name . '.' . $extension,
                'uploads'  // Save it using the 'uploads' disk defined in filesystems.php
            );

            $gpuModel->save(); // Save the GPU model after updating the image path
        }

        // Redirect back to the GPU models list with success message
        return redirect('/gpu-models')->with('success', 'GPU Model updated successfully!');
    }

    // Delete a GPU model from the database
    public function delete(GpuModel $gpuModel): RedirectResponse
    {
        // Check if the model has an image and delete it from the storage
        if ($gpuModel->image) {
            // Delete the image file from the 'images' directory
            unlink(public_path('images/' . $gpuModel->image));
        }

        // Delete the GPU model from the database
        $gpuModel->delete();

        // Redirect back to the GPU models list
        return redirect('/gpu-models');
    }
}
