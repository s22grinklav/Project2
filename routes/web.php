<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GpuGenerationController;
use App\Http\Controllers\GpuModelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GpuArchitectureController;
use App\Http\Controllers\GpuDataController;

// Route for HomeController
Route::get('/', [HomeController::class, 'index']);

// Auth routes (these are public routes, so no changes needed here)
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

// Protected routes for GPU Generations, GPU Models, and GPU Architectures
Route::middleware(['auth'])->group(function () {

    // GPU Generation Routes
    Route::get('/gpu-generations', [GpuGenerationController::class, 'list']); // List GPU generations
    Route::get('/gpu-generations/create', [GpuGenerationController::class, 'create']);  // Show form to create a new GPU generation
    Route::post('/gpu-generations/put', [GpuGenerationController::class, 'put']);  // Process the form to save a new GPU generation
    Route::get('/gpu-generations/update/{gpuGeneration}', [GpuGenerationController::class, 'update']);  // Show form to edit an existing GPU generation
    Route::post('/gpu-generations/patch/{gpuGeneration}', [GpuGenerationController::class, 'patch']);  // Process the edit
    Route::post('/gpu-generations/delete/{gpuGeneration}', [GpuGenerationController::class, 'delete']);  // Delete route

    // GPU Model Routes
    Route::get('/gpu-models', [GpuModelController::class, 'list']); // List GPU models
    Route::get('/gpu-models/create', [GpuModelController::class, 'create']);  // Show form to create a new GPU model
    Route::post('/gpu-models/put', [GpuModelController::class, 'put']);  // Process the form to save a new GPU model
    Route::get('/gpu-models/update/{gpuModel}', [GpuModelController::class, 'update']);  // Show form to edit an existing GPU model
    Route::post('/gpu-models/patch/{gpuModel}', [GpuModelController::class, 'patch']);  // Process the edit
    Route::post('/gpu-models/delete/{gpuModel}', [GpuModelController::class, 'delete']);  // Delete route

    // Add this route for GPU architectures
    Route::get('/gpu-architectures', [GpuArchitectureController::class, 'list'])->name('gpu-architectures.list');
    Route::get('/gpu-architectures/create', [GpuArchitectureController::class, 'create'])->name('gpu-architectures.create');
    Route::post('/gpu-architectures', [GpuArchitectureController::class, 'store'])->name('gpu-architectures.store');
    Route::get('/gpu-architectures/{gpuArchitecture}/edit', [GpuArchitectureController::class, 'edit'])->name('gpu-architectures.edit');
    Route::patch('/gpu-architectures/{gpuArchitecture}', [GpuArchitectureController::class, 'update'])->name('gpu-architectures.update');
    Route::delete('/gpu-architectures/{gpuArchitecture}', [GpuArchitectureController::class, 'destroy'])->name('gpu-architectures.delete');

    Route::get('/data/get-top-gpus', [GpuDataController::class, 'getTopGpus']);
    Route::get('/data/get-gpu/{gpu}', [GpuDataController::class, 'getGpu']);
    Route::get('/data/get-related-gpus/{gpu}', [GpuDataController::class, 'getRelatedGpus']);
});
