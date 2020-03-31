<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$subjects=[];

        for ($i = 1; $i<=6; $i++) {
        	$sName = 'Предмет '.$i;

        	$subjects[] = ['name' => $sName];
        }

        DB::table('subjects')->insert($subjects);
    }
}
