@extends('marketing.layout.master')

@section('page_title'){{ $article->page_title != '' ? $article->page_title : 'Прайс-лист' }}@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => $article->page_h1 != '' ? $article->page_h1 : 'Прайс-лист',
                'items' => [
                        ['title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE],
                        ['title' => 'Праймер', 'action' => 'Marketing\Companies\AboutController@getShow', 'action_params' => ['shortTitle' => 'primer'], 'active' => FALSE],
                        ['title' => 'Прайс-лист', 'action' => '', 'active' => TRUE],
                ]
            ])
@stop

@section('content')
    <div class="row margin-bottom-20 margin-top-20">
        <div class="col-md-12">
            {!! $article->full_text !!}
        </div>
    </div>

    <div class="row margin-bottom-20 margin-top-20">
        <div class="col-md-12">
            <p class="lead"><a target="_blank" href="{{ asset('assets/price-list/'.$file_name) }}">Скачать прайс-лист</a></p>
        </div>
    </div>
@stop

@section('meta')
    <meta name="keywords" content="{{ $article->page_keywords }}">
    <meta name="description" content="{{ trim($article->page_description) != '' ? $article->page_description : str_limit(strip_tags($article->full_text), 200) }}">
@stop