<?php

namespace App\Http\Controllers\Marketing;

use App\Article;
use App\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class VideosController extends Controller
{
    /**
     * Отображает индексную страницу модуля.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        // Статья
        Model::unguard();
        $data['videos_description'] = Article::firstOrCreate(['type' => 'videos_description']);
        Model::reguard();

        // Видео
        $data['videos'] = Video::orderBy('created_at', 'DESC')->paginate(4);

        return view('marketing.videos.index', $data);
    }
}
