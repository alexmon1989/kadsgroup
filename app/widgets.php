<?php

// app/widgets.php

use App\News;
use App\Article;

// Виджет слайдера
Widget::register('slider', function()
{
    return view('marketing.widgets.slider');
});

// Виджет новостей в футере
Widget::register('footer_latest_news', function()
{
    // Получаем новости, которые должны быть на главной
    $data['news'] = News::whereIsOnMain(TRUE)
        ->orderBy('created_at', 'DESC')
        ->limit(3)
        ->get();
    // Отображаем
    return view('marketing.widgets.footer_latest_news', $data);
});

// Виджет "О Компании" в футере
Widget::register('footer_about', function()
{
    // Получаем данные
    $data['text'] = Article::firstOrCreate(['type' => 'footer_about'])->full_text;

    // Отображаем
    return view('marketing.widgets.footer_about', $data);
});

// Виджет "Зв'яжіться з нами" в футере
Widget::register('footer_contacts', function()
{
    // Получаем данные
    $data['text'] = Article::firstOrCreate(['type' => 'footer_contacts'])->full_text;

    // Отображаем
    return view('marketing.widgets.footer_contacts', $data);
});