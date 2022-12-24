<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionChatTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_chat_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('locale');
            $table->integer('question_chat_id')->unsigned();
            $table->string('question_title');
            $table->unique(['question_chat_id', 'locale']);
            $table->foreign('question_chat_id')->references('id')->on('question_chats')->onDelete('cascade');
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
        Schema::dropIfExists('question_chat_translations');
    }
}
