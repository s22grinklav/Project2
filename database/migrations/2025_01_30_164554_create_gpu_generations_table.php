<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gpu_generations', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name')->unique(); // Generation Name (e.g., GTX 10, RTX 20, etc.)
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gpu_generations');
    }
};
