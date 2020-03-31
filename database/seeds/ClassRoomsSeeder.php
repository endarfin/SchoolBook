<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassRoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$rooms=[];

        for ($i = 1; $i<=6; $i++) {
        	$sName = 'Кабинет '.$i;

        	$rooms[] = ['name' => $sName];
        }

        DB::table('class_rooms')->insert($rooms);
    }
}
