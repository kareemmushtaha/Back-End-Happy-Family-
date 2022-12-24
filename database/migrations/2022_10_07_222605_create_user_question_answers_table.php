<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_question_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('question_id')->nullable();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->unsignedInteger('answer_question_id')->nullable();
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
        Schema::dropIfExists('user_question_answers');
    }
}
