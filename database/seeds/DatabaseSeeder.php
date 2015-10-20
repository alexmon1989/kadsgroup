<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(NewsTableSeeder::class);
        $this->call(CertificatesTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(GalleriesTableSeeder::class);
        $this->call(SlidersTableSeeder::class);

        Model::reguard();
    }
}
