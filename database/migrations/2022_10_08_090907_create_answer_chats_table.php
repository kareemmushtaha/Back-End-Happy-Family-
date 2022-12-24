<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_chats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('custom_user_id')->unsigned()->nullable();
            $table->foreign('custom_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('answer_chats');
    }
}
