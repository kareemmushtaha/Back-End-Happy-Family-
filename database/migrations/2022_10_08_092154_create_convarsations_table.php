<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvarsationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('received_id')->unsigned();
            $table->foreign('received_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('chat_id')->unsigned();
            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');
            $table->integer('question_chat_id')->unsigned();
            $table->foreign('question_chat_id')->references('id')->on('question_chats')->onDelete('cascade');
            $table->integer('answer_chat_id')->unsigned()->nullable();
            $table->foreign('answer_chat_id')->references('id')->on('answer_chats')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversations');
    }
}
