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
        Schema::table('resources', function (Blueprint $table) {
            $table->unsignedBigInteger('image_id')->nullable();
            $table->foreign('image_id')
                ->references('id')
                ->on('images')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
        Schema::table('tiles', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->unsignedBigInteger('image_id')->nullable();
            $table->foreign('image_id')
                ->references('id')
                ->on('images')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
        Schema::table('skills', function (Blueprint $table) {
            $table->unsignedBigInteger('image_id')->nullable();
            $table->foreign('image_id')
                ->references('id')
                ->on('images')
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
        Schema::table('resources', function (Blueprint $table) {
            $table->dropColumn('image_id');
        });
        Schema::table('tiles', function (Blueprint $table) {
            $table->dropColumn('image_id');
            $table->text('image');
        });
        Schema::table('skills', function (Blueprint $table) {
            $table->dropColumn('image_id');
        });
    }
};
