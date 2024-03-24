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
        Schema::create('heroes_quests', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('hero_id');
            $table->foreign('hero_id')
                ->references('id')
                ->on('heroes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('quest_id');
            $table->foreign('quest_id')
                ->references('id')
                ->on('quests')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('heroes_quests');
    }
};
