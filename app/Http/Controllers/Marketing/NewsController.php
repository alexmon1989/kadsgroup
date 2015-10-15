<?php

namespace App\Http\Controllers\Marketing;

use App\News;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Отображает список новостей.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['news'] = News::orderBy('created_at', 'DESC')->paginate(4);

        return view('marketing.news.index', $data);
    }

    /**
     * Отображает одну новость.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getShow($id)
    {
        // Получаем новость из БД
        $data['news'] = News::find($id);
        if (!empty($data['news'])) {
            // Последние 3 новости
            $data['latest_news'] = News::where('id', '<>', $id)
                ->orderBy('created_at', 'DESC')
                ->take(3)
                ->get();
            // Отображаем представление
            return view('marketing.news.show', $data);
        } else {
            abort(404);
        }
    }
}
