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
        Schema::create('tiles', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->text('title');
            $table->smallInteger('width');
            $table->smallInteger('height');
            $table->boolean('collision')->default(false);
            $table->text('event')->nullable()->comment('дя вызова функции при коллизии');
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
        Schema::dropIfExists('tiles');
    }
};
