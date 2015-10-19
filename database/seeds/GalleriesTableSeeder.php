<?php

use Illuminate\Database\Seeder;

class GalleriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('galleries')->truncate();

        File::cleanDirectory(public_path('assets/img/galleries'));

        factory(App\Gallery::class, 100)->create();
    }
}