<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('gpu_architectures', function (Blueprint $table) {
            $table->string('name')->after('id'); // Adds 'name' column after 'id'
        });
    }

    public function down(): void
    {
        Schema::table('gpu_architectures', function (Blueprint $table) {
            $table->dropColumn('name'); // Removes 'name' column if rolled back
        });
    }
};
