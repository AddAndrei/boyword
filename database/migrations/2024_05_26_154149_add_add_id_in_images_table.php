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
        Schema::table('images', function (Blueprint $table) {
            $table->unsignedBigInteger('add_id')->nullable();
            $table->foreign('add_id')
                ->references('id')
                ->on('adds')
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
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign('images_add_id_foreign');
            $table->dropColumn('add_id');
        });
    }
};
