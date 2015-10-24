<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('news')->truncate();

        File::cleanDirectory(public_path('assets/img/news'));

        factory(App\News::class, 10)->create();
    }
}
