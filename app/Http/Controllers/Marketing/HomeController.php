<?php

namespace App\Http\Controllers\Marketing;

use App\Article;
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
        $data['article'] = Article::whereType('main_article')->first();

        return view('marketing.home.index', $data);
    }
}
