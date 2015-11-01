<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\GroupsCategory;

class GroupsCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('groups_categories')->truncate();

        Model::unguard();

        $faker = Faker\Factory::create();

        GroupsCategory::create([
            'title' => 'Класифікація',
            'company_id' => 1,
            'order' => 1,
            'enabled' => TRUE,
            'description' => $faker->text(),
        ]);

        GroupsCategory::create([
            'title' => 'Будівництво',
            'company_id' => 1,
            'order' => 2,
            'enabled' => TRUE,
            'description' => $faker->text(),
        ]);

        GroupsCategory::create([
            'title' => 'Будівельна хімія',
            'company_id' => 3,
            'order' => 1,
            'enabled' => TRUE,
            'description' => $faker->text(),
        ]);

        GroupsCategory::create([
            'title' => 'Группа 1',
            'company_id' => 2,
            'order' => 1,
            'enabled' => TRUE,
            'description' => $faker->text(),
        ]);

        Model::reguard();
    }
}
