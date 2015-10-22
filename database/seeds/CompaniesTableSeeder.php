<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Company;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('companies')->truncate();

        Model::unguard();

        Company::create([
            'title' => 'Sika',
            'short_title' => 'sika',
            'file_main' => '1.jpg',
            'file_logo' => '1.png'
        ]);
        Company::create([
            'title' => 'SFS intec',
            'short_title' => 'sfs',
            'file_main' => '2.jpg',
            'file_logo' => '2.png'
        ]);
        Company::create([
            'title' => 'Праймер',
            'short_title' => 'primer',
            'file_main' => '3.jpg',
            'file_logo' => '3.png'
        ]);

        Model::reguard();
    }
}
