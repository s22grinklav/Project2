<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GpuGenerationController;
use App\Http\Controllers\AuthController;

// Route for HomeController
Route::get('/', [HomeController::class, 'index']);

// GPU Generation Routes
Route::get('/gpu-generations', [GpuGenerationController::class, 'list']); // List GPU generations
Route::get('/gpu-generations/create', [GpuGenerationController::class, 'create']);  // Show form to create a new GPU generation
Route::post('/gpu-generations/put', [GpuGenerationController::class, 'put']);  // Process the form to save a new GPU generation
Route::get('/gpu-generations/update/{gpuGeneration}', [GpuGenerationController::class, 'update']);  // Show form to edit an existing GPU generation
Route::post('/gpu-generations/patch/{gpuGeneration}', [GpuGenerationController::class, 'patch']);  // Process the edit
Route::post('/gpu-generations/delete/{gpuGeneration}', [GpuGenerationController::class, 'delete']);  // Delete route

// Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);
