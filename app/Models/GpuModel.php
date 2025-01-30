<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GpuModel extends Model
{
    // Specify the table name
    protected $table = 'gpu_models';

    // Specify the primary key
    protected $primaryKey = 'id';

    // Allow mass-assignment for the columns
    protected $fillable = [
        'name',
        'base_clock',
        'boost_clock',
        'cuda_cores',
        'memory_type',
        'vram',
        'generation_id', // Foreign key for the GPU generation
    ];

    /**
     * Get the GPU generation associated with this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function generation(): BelongsTo
    {
        return $this->belongsTo(GpuGeneration::class, 'generation_id'); // 'generation_id' is the foreign key in gpu_models table
    }
}
