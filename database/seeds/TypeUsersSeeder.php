<?php

use Illuminate\Database\Seeder;

class TypeUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
    	DB::table('type_users')->insert([
    										['name' => "Студент"],
    										['name' => "Преподаватель"],
    										['name' => "Администратор"]
    									]);
    						
    
    }
}
