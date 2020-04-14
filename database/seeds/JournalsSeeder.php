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

            ['lesson_id' => 1, 'student_id' =>7, 'exist' => 'y', 'mark' =>3 ],
            ['lesson_id' => 1, 'student_id' =>8, 'exist' => 'y', 'mark' =>3 ],
            ['lesson_id' => 1, 'student_id' =>9, 'exist' => 'l', 'mark' =>null ],
            ['lesson_id' => 2, 'student_id' =>10, 'exist' => 'y', 'mark' =>4 ],
            ['lesson_id' => 2, 'student_id' =>11, 'exist' => 'y', 'mark' =>5 ],
            ['lesson_id' => 2, 'student_id' =>12, 'exist' => 'n', 'mark' =>null ]

        ]);
    }
}
