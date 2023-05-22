<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('fake_name')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('year')->nullable();
            $table->string('gender')->nullable();
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->string('nationality')->nullable();
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->integer('check_active_mediator')->default(0);
            $table->integer('check_active')->default(0);
            $table->integer('show_profile')->default(1);
            $table->bigInteger('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->string('swear_god')->nullable();
            $table->foreignId('mediator_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('code')->nullable();
            $table->string('email')->nullable()->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->boolean('verified')->default(0)->nullable();
            $table->datetime('verified_at')->nullable();
            $table->string('verification_token')->nullable();
            $table->boolean('two_factor')->default(0)->nullable();
            $table->string('two_factor_code')->nullable();
            $table->string('remember_token')->nullable();
            $table->datetime('two_factor_expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


    }


}
