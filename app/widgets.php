<?php

// app/widgets.php

use App\News;

// Виджет слайдера
Widget::register('slider', function()
{
    return view('marketing.widgets.slider');
});

// Виджет новостей в футере
Widget::register('latest_news_footer', function()
{
    // Получаем новости, которые должны быть на главной
    $data['news'] = News::whereIsOnMain(TRUE)
        ->orderBy('created_at', 'DESC')
        ->limit(3)
        ->get();
    // Отображаем
    return view('marketing.widgets.latest_news_footer', $data);
});