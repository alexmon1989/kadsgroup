@extends('marketing.layout.master')

@section('page_title')
Результати пошуку
@stop

@section('top_content')
@slider()
@include('marketing.layout.breadcrumbs', [
            'title' => 'Результати пошуку',
            'items' => [
                    ['title' => 'Головна', 'action' => 'Marketing\HomeController@index', 'active' => FALSE],
                    ['title' => 'Результати пошуку', 'action' => '', 'active' => TRUE],
            ]
        ])
@stop

@section('content')

<!--=== Search Block Version 2 ===-->
<div class="search-block-v2">
    <div class="container">
        <div class="col-md-6 col-md-offset-3 search">
            <h2>Пошук ще раз</h2>
            <div class="input-group">
                <form action="{{ action('Marketing\SearchController@getIndex') }}" method="get">
                    <input type="text" class="form-control" name="q" value="{{ Input::get('q') }}" placeholder="Введіть строку пошуку...">
                    <span class="input-group-btn">
                        <button class="btn-u" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div><!--/container-->
<!--=== End Search Block Version 2 ===-->

<!--=== Search Results ===-->
<div class="container s-results margin-bottom-50">
    @if (Session::get('errors'))
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4>Помилка!</h4>
        @foreach (Session::get('errors')->getMessages() as $msg)
            @foreach ($msg as $value)
                {{ $value }}<br>
            @endforeach
        @endforeach
    </div>
    @endif

    <span class="results-number">Всього результатів: {{ isset($res_count) ? $res_count : '0' }} </span>

    @if (isset($news) and count($news) > 0)
        <h2>Новости</h2>
        @foreach($news as $item)
                <!-- Begin Inner Results -->
        <div class="inner-results">
            <h3><a href="{{ action('Marketing\NewsController@getShow', ['id' => $item->id]) }}">{{ $item->title }}</a></h3>
            <ul class="list-inline up-ul">
                <li>Создано: {{ date('d.m.Y', strtotime($item->created_at)) }}</li>
            </ul>
            {!! str_limit(strip_tags($item->full_text), 400) !!}
        </div>
        <!-- Begin Inner Results -->
        <hr>
        @endforeach
    @endif

    @if (isset($products_sika) and count($products_sika) > 0)
        <h2>Продукти Sika</h2>
        @foreach($products_sika as $item)
        <!-- Begin Inner Results -->
        <div class="inner-results">
            <div class="row margin-bottom-10">
                <div class="col-md-12">
                    <h3><a href="{{ action('Marketing\Companies\Sika\CatalogController@getShow', ['id'=>$item->id]) }}">{{ $item->title }}</a></h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                    <img alt="{{ $item->title }}" src="{{ asset('assets/img/products/sika/'.$item->photo) }}" class="img-responsive">
                </span>
                </div>
                <div class="col-md-11">
                    {!! $item->description !!}

                    {!! $item->package_list !!}
                </div>
            </div>
        </div>
        <!-- Begin Inner Results -->
        <hr>
        @endforeach
    @endif

    @if (isset($products_primer) and count($products_primer) > 0)
        <h2>Продукти Primer</h2>
        @foreach($products_primer as $item)
        <!-- Begin Inner Results -->
        <div class="inner-results">
            <div class="row margin-bottom-10">
                <div class="col-md-12">
                    <h3><a href="{{ action('Marketing\Companies\Primer\CatalogController@getShow', ['id'=>$item->id]) }}">{{ $item->title }}</a></h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                    <img alt="{{ $item->title }}" src="{{ asset('assets/img/products/primer/'.$item->photo) }}" class="img-responsive">
                    </span>
                </div>
                <div class="col-md-11">
                    <p><strong>{{ $item->description_small }}</strong></p>

                    {!! $item->description_full !!}

                    <p><strong>Фасовка:</strong> {!! $item->package !!}</p>
                </div>
            </div>
        </div>
        <!-- Begin Inner Results -->
        <hr>
        @endforeach
    @endif

    @if (isset($products_sfs) and count($products_sfs) > 0)
        <h2>Продукти Sfs</h2>
        @foreach($products_sfs as $item)
        <!-- Begin Inner Results -->
        <div class="inner-results">
            <div class="row margin-bottom-10">
                <div class="col-md-12">
                    <h3><a href="{{ action('Marketing\Companies\Sfs\CatalogController@getIndex', ['categoryId' => $item->category->id]) }}">{{ $item->title }}</a></h3>
                </div>
            </div>
        </div>
        <!-- Begin Inner Results -->
        <hr>
        @endforeach
    @endif

</div><!--/container-->
<!--=== End Search Results ===-->

@stop

@section('styles')
    <link rel="stylesheet" href="assets/css/pages/page_search_inner.css">
@stop