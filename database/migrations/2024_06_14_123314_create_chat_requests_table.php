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
        Schema::create('chat_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->foreign('sender_id')
                ->references('id')
                ->on('profiles')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('receiver_id');
            $table->foreign('receiver_id')
                ->references('id')
                ->on('profiles')
                ->onUpdate('cascade');
            $table->enum('status', ['Pending', 'Approve', 'Reject']);
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
        Schema::dropIfExists('chat_requests');
    }
};
