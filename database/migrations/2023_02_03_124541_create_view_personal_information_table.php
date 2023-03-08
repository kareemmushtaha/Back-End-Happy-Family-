<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewPersonalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_personal_information', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('from_user_id')->unsigned()->nullable();
            $table->foreign('from_user_id', 'uId1')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('to_user_id')->unsigned()->nullable();
            $table->foreign('to_user_id', 'uId2')->references('id')->on('users')->onDelete('cascade');
            $table->integer('price');
            $table->text('hashToken')->nullable();
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
        Schema::dropIfExists('view_personal_information');
    }
}
