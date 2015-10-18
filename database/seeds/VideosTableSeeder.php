<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Video;

class VideosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('videos')->truncate();

        Model::unguard();

        Video::create(['youtube_id' => 'fdhSrchAzrk']);
        Video::create(['youtube_id' => '4nROcTVrQyY']);
        Video::create(['youtube_id' => 'hpfAr6y_CYw']);
        Video::create(['youtube_id' => 'FcfjyG4Dis4']);
        Video::create(['youtube_id' => 'dElW3KVPjtA']);

        Model::reguard();
    }
}
