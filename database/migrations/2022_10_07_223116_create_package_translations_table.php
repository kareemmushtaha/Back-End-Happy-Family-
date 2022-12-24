<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('package_id')->unsigned();
            $table->string('locale');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('subscription_features')->nullable();
            $table->unique(['package_id', 'locale']);
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
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
        Schema::dropIfExists('package_translations');
    }
}
