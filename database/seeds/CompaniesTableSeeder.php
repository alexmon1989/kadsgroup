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

        Company::create(['title' => 'Sika', 'short_title' => 'sika']);
        Company::create(['title' => 'SFS intec', 'short_title' => 'sfs']);
        Company::create(['title' => 'Праймер', 'short_title' => 'primer']);

        Model::reguard();
    }
}
