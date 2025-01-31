<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GpuArchitectureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;  // You can add authentication logic here if needed
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ];
    }
}