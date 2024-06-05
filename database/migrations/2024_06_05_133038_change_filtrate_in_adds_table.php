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
            $table->dropColumn('filtrate');
        });
        Schema::table('adds', function (Blueprint $table) {
            $table->bigInteger('filtrate');
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
            $table->dropColumn('filtrate');
        });
        Schema::table('adds', function (Blueprint $table) {
            $table->integer('filtrate');
        });
    }
};
