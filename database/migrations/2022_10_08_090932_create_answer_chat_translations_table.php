<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerChatTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_chat_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('locale');
            $table->integer('answer_chat_id')->unsigned();
            $table->string('answer_title');
            $table->unique(['answer_chat_id', 'locale']);
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
        Schema::dropIfExists('answer_chat_translations');
    }
}
