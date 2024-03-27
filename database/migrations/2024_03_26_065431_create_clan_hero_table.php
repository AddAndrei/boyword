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
        Schema::create('clan_heroes', function (Blueprint $table) {
            $table->unsignedBigInteger('clan_id');
            $table->foreign('clan_id')
                ->references('id')
                ->on('clans')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('hero_id');
            $table->foreign('hero_id')
                ->references('id')
                ->on('heroes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('clan_heroes');
    }
};
