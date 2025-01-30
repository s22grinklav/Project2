<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GpuGeneration extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'gpu_generations';

    // Specify the primary key
    protected $primaryKey = 'id';

    // Allow mass-assignment for the columns
    protected $fillable = [
        'name', // GPU Generation Name (e.g., GeForce 10, GeForce 20, etc.)
    ];

    // If you don't want to use timestamps (created_at, updated_at) set this to false
    // public $timestamps = false;
}
