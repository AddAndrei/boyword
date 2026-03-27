<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('marks_models_pivot', function (Blueprint $table) {
            $table->unsignedBigInteger('mark_id');
            $table->foreign('mark_id')
                ->references('id')
                ->on('marks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('model_id');
            $table->foreign('model_id')
                ->references('id')
                ->on('models')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('marks_models_pivot');
    }
};
