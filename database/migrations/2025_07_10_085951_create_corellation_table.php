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
        Schema::create('corellation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('match_id');
            $table->text('forecast');
            $table->float('left_team_strong');
            $table->float('right_team_strong');
            $table->text('result');
            $table->boolean('predict');
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
        Schema::dropIfExists('corellation');
    }
};
