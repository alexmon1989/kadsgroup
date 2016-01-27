@extends('marketing.layout.master')

@section('page_title'){{ $news->page_title != '' ? $news->page_title  : $news->title }}@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => $news->page_h1 != '' ? $news->page_h1 : $news->title,
                'items' => [
                        ['title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE],
                        ['title' => 'Новости', 'action' => 'Marketing\NewsController@getIndex', 'active' => FALSE],
                        ['title' => $news->title, 'action' => '', 'active' => TRUE],
                ]
            ])
@stop

@section('content')

<!-- News v3 -->
<div class="news-v3">
    <div class="news-v3-in">
        <ul class="list-inline posted-info">
            <li>Создано {{ date('d.m.Y', strtotime($news->created_at)) }}</li>
        </ul>
        <h2><a href="{{ action('Marketing\NewsController@getShow', ['id' => $news->id]) }}">{{ $news->title }}</a></h2>
        {!! $news->full_text !!}
    </div>
</div>
<!-- End News v3 -->

<h2>Ещё новости</h2>
<!-- Authored Blog -->
<div class="row news-v2">
    @foreach($latest_news as $item)
    <div class="col-sm-4 sm-margin-bottom-30">
        <div class="news-v2-badge">
            <a href="{{ action('Marketing\NewsController@getShow', ['id' => $item->id]) }}"><img class="img-responsive" src="{{ asset('assets/img/news/'.$item->thumbnail) }}" alt="{{ $item->title }}"></a>
        </div>
        <div class="news-v2-desc">
            <h3><a href="{{ action('Marketing\NewsController@getShow', ['id' => $item->id]) }}">{{ $item->title }}</a></h3>
            <small>Создано {{ date('d.m.Y', strtotime($item->created_at)) }}</small>
            <p>{{ $item->preview_text_small }}</p>
        </div>
    </div>
    @endforeach
</div>
<!-- End Authored Blog -->
@stop

@section('meta')
    <meta name="keywords" content="{{ $news->page_keywords }}">
    <meta name="description" content="{{ trim($news->page_description) != '' ? $news->page_description : str_limit(strip_tags($news->full_text), 200) }}">

@stop