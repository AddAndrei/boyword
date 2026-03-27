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
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->decimal('rate', 8, 2);
            $table->enum('operator', ['increment', 'decrement']);
            $table->decimal('balance', 8, 2);
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')
                ->references('id')
                ->on('profiles')
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
        Schema::dropIfExists('balances');
    }
};
