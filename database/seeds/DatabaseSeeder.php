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

        $this->call(NewsTableSeeder::class);
        $this->call(CertificatesTableSeeder::class);
        $this->call(VideosTableSeeder::class);

        Model::reguard();
    }
}
