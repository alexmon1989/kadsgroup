@extends('marketing.layout.master')

@section('page_title'){{ $news_description->page_title != '' ? $news_description->page_title  : 'Новости' }}{{ $news->currentPage() != 1 ? ' - Страница ' . $news->currentPage() : '' }}@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => $news_description->page_h1 != '' ? $news_description->page_h1  : 'Новости',
                'items' => [
                        ['title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE],
                        ['title' => 'Новости', 'action' => '', 'active' => TRUE],
                ]
            ])
@stop

@section('content')
    @if ($news_description->title != '' || $news_description->full_text != '')
        <div class="text-center margin-bottom-50">
            @if ($news_description->title != '')
                <h2 class="{{ $news_description->full_text != '' ? 'title-v2 ' : '' }}title-center text-uppercase">{{ $news_description->title }}</h2>
            @endif
            @if ($news_description->full_text != '')
                <p class="space-lg-hor">{!! $news_description->full_text !!}</p>
            @endif
        </div>
    @endif

    @if (!empty($news))
        @foreach($news as $item)
        <!-- News v3 -->
        <div class="row margin-bottom-20 margin-top-20">
            <div class="col-sm-5 sm-margin-bottom-20">
                <a href="{{ action('Marketing\NewsController@getShow', ['id' => $item->id]) }}"><img class="img-responsive" src="{{ asset('assets/img/news/'.$item->thumbnail) }}" alt="{{ $item->title }}"></a>
            </div>
            <div class="col-sm-7">
                <div class="news-v3">
                    <ul class="list-inline posted-info">
                        <li>Создано {{ date('d.m.Y', strtotime($item->created_at)) }}</li>
                    </ul>
                    <h2><a href="{{ action('Marketing\NewsController@getShow', ['id' => $item->id]) }}">{{ $item->title }}</a></h2>
                    <p>{!! $item->preview_text_mid !!}</p>
                    <p><a class="btn-u btn-u-xs" href="{{ action('Marketing\NewsController@getShow', ['id' => $item->id]) }}">Детальнее <i class="fa fa-angle-right margin-left-5"></i></a></p>

                </div>
            </div>
        </div><!--/end row-->
        <!-- End News v3 -->

        <div class="clearfix margin-bottom-20"><hr></div>
        @endforeach

        <!-- Pager -->
        <div class="text-center">
            {!! str_replace('/?', '?', $news->render()) !!}
        </div>
        <!-- End Pager -->
    @else
        <h2>Новости отсутствуют</h2>
    @endif
@stop

@section('footer')
    @include('marketing.layout.footer')
@stop

@section('meta')
    <meta name="keywords" content="{{ $news_description->page_keywords }}">
    <meta name="description" content="{{ trim($news_description->page_description) != '' ? $news_description->page_description : str_limit(strip_tags($news_description->full_text), 200) }}">

    @if ($news->currentPage() == 1)
    <link rel="canonical" href="{{ url('news') }}"/>
    @endif

    @if ($news->currentPage() < $news->lastPage())
    <link rel="next" href="{{ url('news?page=' . ($news->currentPage() + 1)) }}" />
    @endif

    @if ($news->currentPage() > 1)
    <link rel="prev" href="{{ url('news?page=' . ($news->currentPage() - 1)) }}" />
    @endif
@stop