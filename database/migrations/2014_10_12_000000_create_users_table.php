<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('score')->defualt(0);
            $table->boolean('admin')->defualt(false);
            $table->string('country_id')->nullable();
            $table->string('education')->nullable();
            $table->string('jop')->nullable();
            $table->text('discreption')->nullable();
            $table->string('language_id')->nullable();
            $table->string('image')->defualt('defualt.png');
            $table->string('connection_account')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
