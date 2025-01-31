<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('gpu_architectures', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name'); // Adds 'description' column
        });
    }

    public function down(): void
    {
        Schema::table('gpu_architectures', function (Blueprint $table) {
            $table->dropColumn('description'); // Removes 'description' column if rolled back
        });
    }
};
