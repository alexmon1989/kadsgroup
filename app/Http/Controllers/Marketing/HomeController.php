<?php

namespace App\Http\Controllers\Marketing;

use App\Article;
use App\News;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Действие для отображение главной страницы.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Главная статья
        $data['article'] = Article::whereType('main_article')
            ->first(['full_text', 'page_title', 'page_keywords', 'page_description']);

        // Три новости
        $data['news'] = News::whereIsOnMain(TRUE)
            ->orderBy('created_at', 'DESC')
            ->limit(3)
            ->get();

        // Отображение
        return view('marketing.home.index', $data);
    }
}
