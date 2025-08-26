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
        Schema::create('analyzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('first_team_id')->nullable();
            $table->unsignedBigInteger('second_team_id')->nullable();
            $table->float('rate');
            $table->unsignedBigInteger('win_team_id')->nullable();
            $table->unsignedBigInteger('match_id')->nullable();
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
        Schema::dropIfExists('analyzes');
    }
};
