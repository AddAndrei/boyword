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
        Schema::create('quests', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')
                ->references('id')
                ->on('quests')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->unsignedBigInteger('npc_id');
            $table->foreign('npc_id')
                ->references('id')
                ->on('npcs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('condition_id');
            $table->foreign('condition_id')
                ->references('id')
                ->on('condition_accept_quests')
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
        Schema::dropIfExists('quests');
    }
};
