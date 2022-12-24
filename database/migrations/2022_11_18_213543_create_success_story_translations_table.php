<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuccessStoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('success_story_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('success_story_id')->unsigned();
            $table->string('locale');
            $table->string('title');
            $table->text('description')->nullable();
            $table->unique(['success_story_id', 'locale']);
            $table->foreign('success_story_id')->references('id')->on('success_stories')->onDelete('cascade');
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
        Schema::dropIfExists('success_story_translations');
    }
}
