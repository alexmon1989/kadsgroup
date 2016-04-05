<?php

use Illuminate\Database\Seeder;


class PartnersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('partners')->truncate();

        File::cleanDirectory(public_path('assets/img/partners'));

        factory(App\Partner::class, 10)->create();
    }
}
