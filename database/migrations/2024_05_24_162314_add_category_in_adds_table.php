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
        Schema::table('adds', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('category_id')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('adds', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }
};
