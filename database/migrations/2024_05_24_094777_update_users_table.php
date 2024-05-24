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
        Schema::table('users', function (Blueprint $table){
            $table->dropColumn('email');
        });
        Schema::table('users', function (Blueprint $table){
            $table->string('phone', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table){
            $table->dropColumn(['phone']);
        });
        Schema::table('users', function (Blueprint $table){
            $table->string( 'email');
        });
    }
};
