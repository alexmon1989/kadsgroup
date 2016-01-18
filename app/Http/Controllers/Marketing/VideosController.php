<?php

namespace App\Http\Controllers\Marketing;

use App\Article;
use App\Company;
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
    public function getIndex(Request $request)
    {
        // Проверка правильная ли компания (функциональность должна работать для двух компаний - СФС и Праймер)
        $shortTitle = $request->segment(2);
        if (!in_array($shortTitle, ['sfs', 'primer'])) {
            abort(404);
        }

        // Данные компании
        $data['company'] = Company::whereShortTitle($shortTitle)->first();

        // Статья
        Model::unguard();
        $data['videos_description'] = Article::firstOrCreate(['type' => $shortTitle . '_videos_description']);
        Model::reguard();

        // Видео
        $data['videos'] = $data['company']->videos()->orderBy('created_at', 'DESC')->paginate(4);

        return view('marketing.videos.index', $data);
    }
}
