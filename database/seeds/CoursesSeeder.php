<?php

use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$courses=[];

        for ($i = 1; $i<=5; $i++) {
        	$sName = 'Курс '.$i;

        	$courses[] = ['name' => $sName];
        }

        \DB::table('courses')->insert($courses);
    }
}
