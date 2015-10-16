<?php

use Illuminate\Database\Seeder;

class CertificatesTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('certificates')->truncate();

        File::cleanDirectory(public_path('assets/img/certificates'));

        factory(App\Certificate::class, 10)->create();
    }
}