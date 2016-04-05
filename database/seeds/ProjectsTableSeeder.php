<?php

use Illuminate\Database\Seeder;


class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('projects')->truncate();

        File::cleanDirectory(public_path('assets/img/projects'));

        factory(App\Project::class, 10)->create();
    }
}
