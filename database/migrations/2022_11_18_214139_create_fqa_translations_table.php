<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFqaTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fqa_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fqa_id')->unsigned();
            $table->string('locale');
            $table->string('question');
            $table->text('answer');
            $table->unique(['fqa_id', 'locale']);
            $table->foreign('fqa_id')->references('id')->on('fqas')->onDelete('cascade');
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
        Schema::dropIfExists('fqa_translations');
    }
}
