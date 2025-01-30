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
        Schema::table('gpu_models', function (Blueprint $table) {
            // Add the image column to store the image filename
            $table->string('image')->nullable();  // nullable because some models may not have an image
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gpu_models', function (Blueprint $table) {
            // Drop the image column if rolling back
            $table->dropColumn('image');
        });
    }
};
