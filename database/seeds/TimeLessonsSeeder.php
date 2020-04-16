<?php

use Illuminate\Database\Seeder;

class TimeLessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('time_lessons')->insert([
            ['number' => 1, 'time' => '07:45 09:20'],
            ['number' => 2, 'time' => '09:30 11:05'],
            ['number' => 3, 'time' => '11:15 12:50'],
            ['number' => 4, 'time' => '13:10 14:45'],
            ['number' => 5, 'time' => '14:55 16:30'],
            ['number' => 6, 'time' => '16:40 18:15'],
        ]);
    }
}
