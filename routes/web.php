<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GpuController;
use App\Http\Controllers\AuthController;

// Route for HomeController
Route::get('/', [HomeController::class, 'index']);
// GPU routes
Route::get('/gpus', [GpuController::class, 'list']); //GPU list 
Route::get('/gpus/create', [GpuController::class, 'create']);  // Show form to create a new GPU
Route::post('/gpus/put', [GpuController::class, 'put']);  // Process the form to save a new GPU
Route::get('/gpus/update/{gpu}', [GpuController::class, 'update']);  // Show form to edit an existing GPU
Route::post('/gpus/patch/{gpu}', [GpuController::class, 'patch']);  // Process the edit
Route::post('/gpus/delete/{gpu}', [GpuController::class, 'delete']);  // Delete route
// Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);