<?php

namespace App\Http\Controllers;

use App\Models\GpuModel;
use App\Models\GpuGeneration;
use App\Models\GpuArchitecture; // Import the GpuArchitecture model
use App\Http\Requests\GpuModelRequest;  // Import the GpuModelRequest
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GpuModelController extends Controller
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
        // Fetch all GPU models with eager loaded relationships for generation and architecture
        $items = GpuModel::with(['generation', 'architecture'])->orderBy('name', 'asc')->get();

        // Return the 'gpu_model.list' view with title and items data
        return view('gpu_model.list', [
            'title' => 'GPU Models',  // Title of the page
            'items' => $items         // GPU models data
        ]);
    }

    // Show form to create a new GPU model
    public function create(): View
    {
        // Retrieve all GPU generations and architectures for selection
        $generations = GpuGeneration::all();
        $architectures = GpuArchitecture::all();  // Retrieve all GPU architectures

        // Return the view for creating a new GPU model with title
        return view('gpu_model.form', [
            'title' => 'Create New GPU Model',  // Add the title here
            'gpuModel' => new GpuModel(),      // Pass the empty GPU model instance
            'generations' => $generations,     // Pass the generations for selection
            'architectures' => $architectures // Pass the architectures for selection
        ]);
    }

    // Private method to handle saving GPU model data
    private function saveGpuModelData(GpuModel $gpuModel, GpuModelRequest $request): void
    {
        // Get validated data from the request
        $validatedData = $request->validated();

        // Use mass-assignment to fill the attributes from validated data
        $gpuModel->fill($validatedData);

        // Handle image upload if there's a file
        if ($request->hasFile('image')) {
            // Check if the GPU model has an existing image and delete it
            if ($gpuModel->image) {
                unlink(public_path('uploads/' . $gpuModel->image)); // Delete old image
            }

            // Handle new image upload
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid(); // Generate a unique name for the image
            $gpuModel->image = $uploadedFile->storePubliclyAs('/', $name . '.' . $extension, 'uploads'); // Store the new image
        }

        // Save the GPU model to the database
        $gpuModel->save();
    }

    // Store a new GPU model in the database
    public function put(GpuModelRequest $request): RedirectResponse
    {
        $gpuModel = new GpuModel();  // Create new GPU model instance
        $this->saveGpuModelData($gpuModel, $request);  // Save GPU model data
        return redirect('/gpu-models')->with('success', 'GPU Model created successfully!');
    }

    // Show the form to update an existing GPU model
    public function update(GpuModel $gpuModel): View
    {
        // Retrieve all GPU generations and architectures for selection
        $gpuGenerations = GpuGeneration::all();
        $gpuArchitectures = GpuArchitecture::all(); // Retrieve all GPU architectures

        // Return the view for updating the GPU model with title
        return view('gpu_model.form', [
            'title' => 'Edit GPU Model',
            'gpuModel' => $gpuModel,         // Pass the GPU model instance
            'generations' => $gpuGenerations, // Pass the generations for selection
            'architectures' => $gpuArchitectures // Pass the architectures for selection
        ]);
    }

    // Update the GPU model in the database
    public function patch(GpuModelRequest $request, GpuModel $gpuModel): RedirectResponse
    {
        $this->saveGpuModelData($gpuModel, $request);  // Save GPU model data
        return redirect('/gpu-models')->with('success', 'GPU Model updated successfully!');
    }

    // Delete a GPU model from the database
    public function delete(GpuModel $gpuModel): RedirectResponse
    {
        // Check if the GPU model has an image and delete it
        if ($gpuModel->image) {
            unlink(public_path('uploads/' . $gpuModel->image)); // Delete the image
        }

        // Delete the GPU model from the database
        $gpuModel->delete();

        // Redirect back to the GPU models list
        return redirect('/gpu-models')->with('success', 'GPU Model deleted successfully!');
    }
}
