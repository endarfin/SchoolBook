<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(TypeUsersSeeder::class);
        $this->call(SubjectsSeeder::class);
        $this->call(CoursesSeeder::class);
        $this->call(ClassRoomsSeeder::class);
        $this->call(GroupsSeeder::class);
        $this->call(GroupSubjectSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(TeacherSubjectSeeder::class);
        $this->call(LessonsSeeder::class);
        $this->call(JournalsSeeder::class);
        
        
    }
}
