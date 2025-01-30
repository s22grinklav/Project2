<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GpuModelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Set to true to allow the request to proceed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'generation_id' => 'required|exists:gpu_generations,id',
            'base_clock' => 'required|integer',
            'boost_clock' => 'required|integer',
            'cuda_cores' => 'required|integer',
            'memory_type' => 'required|string',
            'vram' => 'required|integer',
            'image' => 'nullable|image', // Optional image
        ];
    }

    /**
     * Custom messages for validation.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => 'Lauks ":attribute" ir obligāts',
            'min' => 'Laukam ":attribute" jābūt vismaz :min simbolus garam',
            'max' => 'Lauks ":attribute" nedrīkst būt garāks par :max simboliem',
            'boolean' => 'Lauka ":attribute" vērtībai jābūt "true" vai "false"',
            'unique' => 'Šāda lauka ":attribute" vērtība jau ir reģistrēta',
            'numeric' => 'Lauka ":attribute" vērtībai jābūt skaitlim',
            'image' => 'Laukā ":attribute" jāpievieno korekts attēla fails',
        ];
    }

    /**
     * Custom attribute names for validation.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'nosaukums',
            'generation_id' => 'paaudze',
            'base_clock' => 'pamata frekvence',
            'boost_clock' => 'paaugstinātā frekvence',
            'cuda_cores' => 'CUDA kodoli',
            'memory_type' => 'atmiņas tips',
            'vram' => 'VRAM',
            'image' => 'attēls',
        ];
    }
}
