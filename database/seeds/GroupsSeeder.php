<?php

use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$groups=[];

        for ($i = 1; $i<=5; $i++) {
        	$sName = 'Группа '.$i;
        	$courseId = $i;

        	$groups[] = [	
        					'id' => $i,
        					'name' => $sName,
        					'course_id' => $courseId,

        				];
        }

        \DB::table('groups')->insert($groups);
    }
}
