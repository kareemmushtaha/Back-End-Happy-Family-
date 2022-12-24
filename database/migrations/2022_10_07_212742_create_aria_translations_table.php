<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAriaTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aria_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aria_id')->unsigned();
            $table->string('locale');
            $table->string('title');
            $table->unique(['aria_id', 'locale']);
            $table->foreign('aria_id')->references('id')->on('arias')->onDelete('cascade');
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
        Schema::dropIfExists('aria_translations');
    }
}
