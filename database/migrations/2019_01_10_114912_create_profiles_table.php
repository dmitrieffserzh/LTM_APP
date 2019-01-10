<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

    public function up() {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('gender')->unsigned()->default('0');
            $table->string('birthday')->nullable();
            $table->string('location')->nullable();
            $table->text('about')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamp('offline_at')->nullable();
        });
    }

    public function down() {
        Schema::dropIfExists('profiles');
    }
}
