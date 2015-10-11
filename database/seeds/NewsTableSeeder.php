<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('news')->truncate();

        factory(App\News::class, 10)->create();
    }
}
