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
                $table->string('login');
                $table->string('password');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('first_name');
                $table->string('surname');
                $table->integer('phone')->unique();
                $table->integer('type_user')->unsigned();
                $table->integer('student_group')->unsigned();
                $table->foreign('type_user')->references('id')->on('type_users')->onDelete('cascade');
                $table->foreign('student_group')->references('id')->on('groups')->onDelete('cascade');
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
