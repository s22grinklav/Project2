<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gpu extends Model
{
    use HasFactory;

    // Specify the table name (optional if the table follows Laravel's naming convention)
    protected $table = 'gpus';

    // Specify the primary key (optional if the primary key follows Laravel's convention)
    protected $primaryKey = 'id';

    // Allow mass-assignment for the columns
    protected $fillable = [
        'name',
        'series',
        'architecture',
        'vram',
        'memory_type',
        'base_clock',
        'boost_clock',
        'cuda_cores'
    ];

    // If you don't want to use timestamps (created_at, updated_at) set this to false
    // public $timestamps = false;
}
