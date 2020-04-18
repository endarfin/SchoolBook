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
            ['lessons_id' => 2, 'student_id' =>12, 'mark' =>null ],
            ['lessons_id' => 3, 'student_id' =>13, 'mark' =>'n' ],
            ['lessons_id' => 3, 'student_id' =>14, 'mark' =>5 ],
            ['lessons_id' => 3, 'student_id' =>15, 'mark' =>null ],

            ['lessons_id' => 4, 'student_id' =>7, 'mark' =>5 ],
            ['lessons_id' => 4, 'student_id' =>8, 'mark' =>4 ],
            ['lessons_id' => 4, 'student_id' =>9, 'mark' =>null ],
            ['lessons_id' => 5, 'student_id' =>10, 'mark' =>'n' ],
            ['lessons_id' => 5, 'student_id' =>11, 'mark' =>3 ],
            ['lessons_id' => 5, 'student_id' =>12, 'mark' =>5 ],
            ['lessons_id' => 6, 'student_id' =>13, 'mark' =>'n' ],
            ['lessons_id' => 6, 'student_id' =>14, 'mark' =>5 ],
            ['lessons_id' => 6, 'student_id' =>15, 'mark' =>null ],

            ['lessons_id' => 7, 'student_id' =>7, 'mark' =>'n' ],
            ['lessons_id' => 7, 'student_id' =>8, 'mark' =>3 ],
            ['lessons_id' => 7, 'student_id' =>9, 'mark' =>null ],
            ['lessons_id' => 8, 'student_id' =>10, 'mark' =>'n' ],
            ['lessons_id' => 8, 'student_id' =>11, 'mark' =>null ],
            ['lessons_id' => 8, 'student_id' =>12, 'mark' =>4 ],
            ['lessons_id' => 9, 'student_id' =>13, 'mark' =>'n' ],
            ['lessons_id' => 9, 'student_id' =>14, 'mark' =>5 ],
            ['lessons_id' => 9, 'student_id' =>15, 'mark' =>null ],

            ['lessons_id' => 10, 'student_id' =>7, 'mark' =>3 ],
            ['lessons_id' => 10, 'student_id' =>8, 'mark' =>'n' ],
            ['lessons_id' => 10, 'student_id' =>9, 'mark' => null ],
            ['lessons_id' => 11, 'student_id' =>10, 'mark' =>'n' ],
            ['lessons_id' => 11, 'student_id' =>11, 'mark' =>null ],
            ['lessons_id' => 11, 'student_id' =>12, 'mark' =>3 ],
            ['lessons_id' => 12, 'student_id' =>13, 'mark' =>'n' ],
            ['lessons_id' => 12, 'student_id' =>14, 'mark' =>5 ],
            ['lessons_id' => 12, 'student_id' =>15, 'mark' =>null ],

            ['lessons_id' => 13, 'student_id' =>7, 'mark' =>3 ],
            ['lessons_id' => 13, 'student_id' =>8, 'mark' =>3 ],
            ['lessons_id' => 13, 'student_id' =>9, 'mark' =>null ],
            ['lessons_id' => 14, 'student_id' =>10, 'mark' => 2 ],
            ['lessons_id' => 14, 'student_id' =>11, 'mark' =>null ],
            ['lessons_id' => 14, 'student_id' =>12, 'mark' =>'n' ],
            ['lessons_id' => 15, 'student_id' =>13, 'mark' =>'n' ],
            ['lessons_id' => 15, 'student_id' =>14, 'mark' =>5 ],
            ['lessons_id' => 15, 'student_id' =>15, 'mark' =>null ],

            ['lessons_id' => 16, 'student_id' =>7, 'mark' =>3 ],
            ['lessons_id' => 16, 'student_id' =>8, 'mark' =>3 ],
            ['lessons_id' => 16, 'student_id' =>9, 'mark' =>null ],
            ['lessons_id' => 17, 'student_id' =>10, 'mark' =>'n' ],
            ['lessons_id' => 17, 'student_id' =>11, 'mark' =>5 ],
            ['lessons_id' => 17, 'student_id' =>12, 'mark' => 4 ],
            ['lessons_id' => 18, 'student_id' =>13, 'mark' =>'n' ],
            ['lessons_id' => 18, 'student_id' =>14, 'mark' =>5 ],
            ['lessons_id' => 18, 'student_id' =>15, 'mark' =>null ],

        ]);
    }
}
