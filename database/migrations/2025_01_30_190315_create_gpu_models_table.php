<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
    public function up(): void
    {
        Schema::create('gpu_models', function (Blueprint $table) {
            $table->id(); // auto-incrementing primary key
            $table->foreignId('generation_id'); // foreign key for GPU generation
            $table->string('name'); // name of the GPU model (like RTX 3080)
            $table->integer('base_clock'); // base clock speed in MHz
            $table->integer('boost_clock'); // boost clock speed in MHz
            $table->integer('cuda_cores'); // number of CUDA cores
            $table->string('memory_type'); // memory type (e.g., GDDR6)
            $table->integer('vram'); // VRAM in GB
            $table->timestamps(); // created_at and updated_at
            $table->foreign('generation_id')->references('id')->on('gpu_generations')->onDelete('cascade'); // foreign key constraint for GPU generation
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('gpu_models');
    }
};
