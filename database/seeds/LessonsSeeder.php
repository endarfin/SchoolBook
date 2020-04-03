<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = time();
        for ($i = 1; $i <= 100; $i++) {

            DB::table('lessons')->insert([
                ['date_event' =>  $time, 'group_id' => '1', 'subject_id' => '2', 'user_id' => '3', 'class_room_id' => '1'],
                ['date_event' =>  $time, 'group_id' => '2', 'subject_id' => '3', 'user_id' => '4', 'class_room_id' => '2'],
                ['date_event' =>  $time, 'group_id' => '3', 'subject_id' => '5', 'user_id' => '6', 'class_room_id' => '3'],
//                ['date_event' => date("Y-m-d H:i", $time), 'group_id' => '4', 'subject_id' => '6', 'user_id' => '2', 'class_room_id' => '4'],['date_event' =>  date("Y-m-d H:i", $time), 'group_id' => '1', 'subject_id' => '2', 'user_id' => '3', 'class_room_id' => '1'],
//                ['date_event' =>  date("Y-m-d H:i", $time), 'group_id' => '2', 'subject_id' => '3', 'user_id' => '4', 'class_room_id' => '2'],
//                ['date_event' =>  date("Y-m-d H:i", $time), 'group_id' => '3', 'subject_id' => '5', 'user_id' => '6', 'class_room_id' => '3'],
//                ['date_event' => date("Y-m-d H:i", $time), 'group_id' => '4', 'subject_id' => '6', 'user_id' => '2', 'class_room_id' => '4'],
            ]);
            $time += 28800;
        }

    }
}
