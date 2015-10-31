<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->truncate();

        Model::unguard();

        $faker = Faker\Factory::create();

        Category::create([
            'title' => 'Производство бетона',
            'description' => $faker->text(),
            'group_category_id' => 1,
            'parent_id' => NULL,
            'order' => 1,
            'enabled' => TRUE,
        ]);

        Category::create([
            'title' => 'Пластификаторы для товарного бетона',
            'description' => NULL,
            'group_category_id' => 1,
            'parent_id' => 1,
            'order' => 1,
            'enabled' => TRUE,
        ]);

        Category::create([
            'title' => 'Пластификаторы для изготовления ЖБИ в заводских условиях',
            'description' => NULL,
            'group_category_id' => 1,
            'parent_id' => 1,
            'order' => 2,
            'enabled' => TRUE,
        ]);

        Category::create([
            'title' => 'Подливочные и анкеровочные составы',
            'description' => $faker->text(),
            'group_category_id' => 1,
            'parent_id' => NULL,
            'order' => 2,
            'enabled' => TRUE,
        ]);

        Category::create([
            'title' => 'Подливочные составы на минеральной основе',
            'description' => NULL,
            'group_category_id' => 1,
            'parent_id' => 4,
            'order' => 1,
            'enabled' => TRUE,
        ]);

        Category::create([
            'title' => 'Грунтівки',
            'description' => NULL,
            'group_category_id' => 3,
            'parent_id' => NULL,
            'order' => 1,
            'enabled' => TRUE,
        ]);

        Category::create([
            'title' => 'Лаки',
            'description' => NULL,
            'group_category_id' => 3,
            'parent_id' => NULL,
            'order' => 1,
            'enabled' => TRUE,
        ]);


        Model::reguard();
    }
}
