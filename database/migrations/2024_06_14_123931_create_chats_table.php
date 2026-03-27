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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_request_id');
            $table->foreign('chat_request_id')
                ->references('id')
                ->on('chat_requests')
                ->onUpdate('cascade');

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
            $table->text('message');
            $table->boolean('readable');
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
        Schema::dropIfExists('chats');
    }
};
