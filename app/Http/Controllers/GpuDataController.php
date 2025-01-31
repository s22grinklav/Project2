<?php

// app/Http/Controllers/GpuDataController.php
namespace App\Http\Controllers;

use App\Models\GpuModel;
use Illuminate\Http\JsonResponse;

class GpuDataController extends Controller
{
    // Return 3 random GPU models
    public function getTopGpus(): JsonResponse
    {
        $gpus = GpuModel::with(['generation', 'architecture'])  // Eager load related models
            ->inRandomOrder()
            ->take(3)
            ->get();

        return response()->json($gpus);
    }

    // Return details for a specific GPU model
    public function getGpu(GpuModel $gpu): JsonResponse
    {
        return response()->json($gpu->load(['generation', 'architecture'])); // Eager load related models
    }

    // Return 3 random GPUs related to the selected one
    public function getRelatedGpus(GpuModel $gpu): JsonResponse
    {
        $gpus = GpuModel::with(['generation', 'architecture'])
            ->where('id', '<>', $gpu->id)  // Exclude the current GPU
            ->inRandomOrder()
            ->take(3)
            ->get();

        return response()->json($gpus);
    }
}
