<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            //$table->timestamp('date_event');
            $table->integer('date_event');
            $table->integer('group_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer("class_room_id")->unsigned();
            $table->foreign("class_room_id")->references('id')->on('class_rooms')->onDelete('cascade');
            $table->foreign(array('group_id', 'subject_id'))->references(array('group_id', 'subject_id'))->on('group_subjects')->onDelete('cascade');
            $table->foreign(array('user_id', 'subject_id'))->references(array('user_id', 'subject_id'))->on('teacher_subjects')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
