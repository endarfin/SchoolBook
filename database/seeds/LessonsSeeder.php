<?php

use Illuminate\Database\Seeder;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  	public function run()
    {

 
    	DB::table('lessons')->insert([
   
   										['id'=>1, 'date_event' =>'2020-01-01 10:00:00', 'group_id'=>'1', 'subject_id'=>'2', 'user_id'=>'3', 'class_room_id'=>'1' ],
   										['id'=>2, 'date_event' =>'2020-01-01 10:00:00', 'group_id'=>'2', 'subject_id'=>'3', 'user_id'=>'4', 'class_room_id'=>'2' ],
   										['id'=>3, 'date_event' =>'2020-01-01 10:00:00', 'group_id'=>'3', 'subject_id'=>'5', 'user_id'=>'6', 'class_room_id'=>'3' ],
   										['id'=>4, 'date_event' =>'2020-01-01 10:00:00', 'group_id'=>'4', 'subject_id'=>'6', 'user_id'=>'2', 'class_room_id'=>'4' ],
   										['id'=>5, 'date_event' =>'2020-01-01 12:00:00', 'group_id'=>'5', 'subject_id'=>'1', 'user_id'=>'2', 'class_room_id'=>'5' ],

  			
    								]);
    
	}
}