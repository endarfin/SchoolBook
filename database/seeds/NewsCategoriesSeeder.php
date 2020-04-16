<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        $name = 'Без категории';
        $categories[] = [
            'name' => $name,
            'slug' => str::slug($name),
            'parent_id' => 0,
        ];

        for ($i = 1; $i <= 10; $i++){
            $name = 'Категория №'.$i;
            $id = ($i > 4) ? rand(1, 4) : 1;

            $categories[] = [
                'name' => $name,
                'slug' => str::slug($name),
                'parent_id' => $id,
            ];
        }
        DB::table('news_categories')->insert($categories);
    }
}
