<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerRegisterQuestionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_question_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('answer_question_id')->unsigned();
            $table->string('locale');
            $table->string('answer_title');
            $table->unique(['answer_question_id', 'locale']);
            $table->foreign('answer_question_id')->references('id')->on('answer_questions')->onDelete('cascade');
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
        Schema::dropIfExists('answer_register_question_translations');
    }
}
