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
        Schema::create('adds', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description');
            $table->text('aggregate');
            $table->integer('filtrate');
            $table->decimal('price');
            $table->enum('status',
                ['unconfirmed', 'confirmed', 'denied', 'reviewing'])
                ->default('unconfirmed');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->unsignedBigInteger('mark_id')->nullable();
            $table->foreign('mark_id')
                ->references('id')
                ->on('marks')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->unsignedBigInteger('model_id')->nullable();
            $table->foreign('model_id')
                ->references('id')
                ->on('models')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->unsignedBigInteger('memory_id')->nullable();
            $table->foreign('memory_id')
                ->references('id')
                ->on('memories')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')
                ->references('id')
                ->on('colors')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('adds');
    }
};
