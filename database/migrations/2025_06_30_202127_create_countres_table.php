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
        Schema::create('countres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hero_id');
            $table->foreign('hero_id')
                ->references('id')
                ->on('heroes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->text('vs_hero');
            $table->float('win_rate');
            $table->integer('matches');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('countres');
    }
};
