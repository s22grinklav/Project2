<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGpuArchitectureIdToGpuModelsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('gpu_models', function (Blueprint $table) {
            $table->foreignId('gpu_architecture_id')->nullable()->constrained('gpu_architectures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('gpu_models', function (Blueprint $table) {
            $table->dropForeign(['gpu_architecture_id']);
            $table->dropColumn('gpu_architecture_id');
        });
    }
}
