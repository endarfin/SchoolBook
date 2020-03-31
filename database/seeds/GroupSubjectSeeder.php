<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('group_subject')->insert([

    									['group_id' => 1, 'subject_id' =>1 ],
    									['group_id' => 1, 'subject_id' =>2 ],
    									['group_id' => 2, 'subject_id' =>3 ],
    									['group_id' => 2, 'subject_id' =>4 ],
    									['group_id' => 3, 'subject_id' =>5 ],
    									['group_id' => 3, 'subject_id' =>6 ],
    									['group_id' => 4, 'subject_id' =>5 ],
    									['group_id' => 4, 'subject_id' =>6 ],
    									['group_id' => 5, 'subject_id' =>1 ],
    									['group_id' => 5, 'subject_id' =>3 ],
    								]);
    }
}
