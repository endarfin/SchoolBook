<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
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
                $table->string('login')->unique();
                $table->string('password');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('name');
                $table->string('surname');
                $table->string('phone')->unique();
                $table->integer('type_user_id')->unsigned();
                $table->foreign('type_user_id')->references('id')->on('type_users')->onDelete('cascade');
                $table->integer('group_id')->unsigned()->nullable();
                $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
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
