<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


    	DB::table('users')->insert([

   ['id'=>1, 'login' =>'user 1', 'password'=>'secret 1', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 1', 'surname'=>'Фамилия 1', 'phone'=>'0986706801', 'type_user_id'=>3, 'group_id'=>NULL ],

   ['id'=>2, 'login' =>'user 2', 'password'=>'secret 2', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 2', 'surname'=>'Фамилия 2', 'phone'=>'0986706802', 'type_user_id'=>2, 'group_id'=>NULL ],
   ['id'=>3, 'login' =>'user 3', 'password'=>'secret 3', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 3', 'surname'=>'Фамилия 3', 'phone'=>'0986706803', 'type_user_id'=>2, 'group_id'=>NULL ],
   ['id'=>4, 'login' =>'user 4', 'password'=>'secret 4', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 4', 'surname'=>'Фамилия 4', 'phone'=>'0986706804', 'type_user_id'=>2, 'group_id'=>NULL ],
   ['id'=>5, 'login' =>'user 5', 'password'=>'secret 5', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 5', 'surname'=>'Фамилия 5', 'phone'=>'0986706805', 'type_user_id'=>2, 'group_id'=>NULL ],
   ['id'=>6, 'login' =>'user 6', 'password'=>'secret 6', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 6', 'surname'=>'Фамилия 6', 'phone'=>'0986706806', 'type_user_id'=>2, 'group_id'=>NULL ],
   ['id'=>7, 'login' =>'user 7', 'password'=>'secret 7', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 7', 'surname'=>'Фамилия 7', 'phone'=>'0986706807', 'type_user_id'=>1, 'group_id'=>1 ],
   ['id'=>8, 'login' =>'user 8', 'password'=>'secret 8', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 8', 'surname'=>'Фамилия 8', 'phone'=>'0986706808', 'type_user_id'=>1, 'group_id'=>1 ],
   ['id'=>9, 'login' =>'user 9', 'password'=>'secret 9', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 9', 'surname'=>'Фамилия 9', 'phone'=>'0986706809', 'type_user_id'=>1, 'group_id'=>1 ],
   ['id'=>10, 'login' =>'user 10', 'password'=>'secret 10', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 10', 'surname'=>'Фамилия 10', 'phone'=>'0986706810', 'type_user_id'=>1, 'group_id'=>2 ],
   ['id'=>11, 'login' =>'user 11', 'password'=>'secret 11', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 11', 'surname'=>'Фамилия 11', 'phone'=>'0986706811', 'type_user_id'=>1, 'group_id'=>2 ],
   ['id'=>12, 'login' =>'user 12', 'password'=>'secret 12', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 12', 'surname'=>'Фамилия 12', 'phone'=>'0986706812', 'type_user_id'=>1, 'group_id'=>2 ],
   ['id'=>13, 'login' =>'user 13', 'password'=>'secret 13', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 13', 'surname'=>'Фамилия 13', 'phone'=>'0986706813', 'type_user_id'=>1, 'group_id'=>3 ],
   ['id'=>14, 'login' =>'user 14', 'password'=>'secret 14', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 14', 'surname'=>'Фамилия 14', 'phone'=>'0986706814', 'type_user_id'=>1, 'group_id'=>3 ],
   ['id'=>15, 'login' =>'user 15', 'password'=>'secret 15', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 15', 'surname'=>'Фамилия 15', 'phone'=>'0986706815', 'type_user_id'=>1, 'group_id'=>3 ],
   ['id'=>16, 'login' =>'user 16', 'password'=>'secret 16', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 16', 'surname'=>'Фамилия 16', 'phone'=>'0986706816', 'type_user_id'=>1, 'group_id'=>4 ],
   ['id'=>17, 'login' =>'user 17', 'password'=>'secret 17', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 17', 'surname'=>'Фамилия 17', 'phone'=>'0986706817', 'type_user_id'=>1, 'group_id'=>4 ],
   ['id'=>18, 'login' =>'user 18', 'password'=>'secret 18', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 18', 'surname'=>'Фамилия 18', 'phone'=>'0986706818', 'type_user_id'=>1, 'group_id'=>4 ],
   ['id'=>19, 'login' =>'user 19', 'password'=>'secret 19', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 19', 'surname'=>'Фамилия 19', 'phone'=>'0986706819', 'type_user_id'=>1, 'group_id'=>5 ],
   ['id'=>20, 'login' =>'user 20', 'password'=>'secret 20', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 20', 'surname'=>'Фамилия 20', 'phone'=>'0986706820', 'type_user_id'=>1, 'group_id'=>5 ],
   ['id'=>21, 'login' =>'user 21', 'password'=>'secret 21', 'email'=>Str::random(5).'@gmail.com', 'name'=>'Имя 21', 'surname'=>'Фамилия 21', 'phone'=>'0986706821', 'type_user_id'=>1, 'group_id'=>5 ],

    								]);

	}
}
