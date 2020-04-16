<?php

use Illuminate\Database\Seeder;

class JournalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('journals')->insert([

            ['lessons_id' => 1, 'student_id' =>7, 'mark' =>3 ],
            ['lessons_id' => 1, 'student_id' =>8, 'mark' =>3 ],
            ['lessons_id' => 1, 'student_id' =>9, 'mark' =>null ],
            ['lessons_id' => 2, 'student_id' =>10, 'mark' =>'n' ],
            ['lessons_id' => 2, 'student_id' =>11, 'mark' =>5 ],
            ['lessons_id' => 2, 'student_id' =>12, 'mark' =>null ]

        ]);
    }
}
