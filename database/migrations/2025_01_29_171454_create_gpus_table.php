<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gpus', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // GPU Name
            $table->integer('series'); // GPU Series (1000, 2000, 3000, etc.)
            $table->string('architecture'); // Pascal, Turing, Ampere, Ada Lovelace
            $table->integer('vram'); // VRAM size in GB
            $table->string('memory_type'); // GDDR5, GDDR6, GDDR6X
            $table->decimal('base_clock', 8, 2); // Base clock speed in MHz
            $table->decimal('boost_clock', 8, 2); // Boost clock speed in MHz
            $table->integer('cuda_cores'); // CUDA Cores count
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gpus');
    }
};
