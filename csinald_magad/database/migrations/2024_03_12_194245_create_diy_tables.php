<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiyTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->string('profile_picture')->nullable();
            $table->timestamps();
        });

        Schema::create('creations', function (Blueprint $table) {
            $table->increments('creation_id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->text('instructions')->nullable();
            $table->timestamps();
        });

        Schema::create('saved_creations', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('creation_id');
            $table->primary(['user_id', 'creation_id']);
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('creation_id')->references('creation_id')->on('creations');
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
        Schema::dropIfExists('saved_creations');
        Schema::dropIfExists('creations');
        Schema::dropIfExists('users');
    }
}
