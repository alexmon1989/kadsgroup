@extends('marketing.layout.master')

@section('page_title')
{{ $videos_description->page_title != '' ? $videos_description->page_title : 'Видео "Праймер"' }}
@stop

@section('top_content')
    @slider()

    @include('marketing.layout.breadcrumbs', [
                'title' => $videos_description->page_h1 != '' ? $videos_description->page_h1 : 'Видео "Праймер"',
                'items' => [
                        ['title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE],
                        ['title' => 'Праймер', 'action' => 'Marketing\Companies\AboutController@getShow', 'action_params' => ['shortTitle' => 'primer'], 'active' => FALSE],
                        ['title' => 'Видео', 'action' => '', 'active' => TRUE],
                ]
            ])

@stop

@section('content')
    @if (!empty($videos))

        @if ($videos_description->title != '' || $videos_description->full_text != '')
            <div class="text-center margin-bottom-50">
                @if ($videos_description->title != '')
                    <h2 class="{{ $videos_description->full_text != '' ? 'title-v2 ' : '' }}title-center text-uppercase">{{ $videos_description->title }}</h2>
                @endif
                @if ($videos_description->full_text != '')
                    {!! $videos_description->full_text !!}
                @endif
            </div>
        @endif

        @for($i = 0; $i <= count($videos) - 1; $i += 2)
            <div class="row margin-bottom-30">
                @for($j = 0; $j <= 1; $j++)
                    @if (isset($videos[$i+$j]))
                    <div class="col-sm-6 sm-margin-bottom-30">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $videos[$i+$j]->youtube_id }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                    @endif
                @endfor
            </div>
        @endfor


        <!-- Pager -->
        <div class="text-center">
            {!! str_replace('/?', '?', $videos->render()) !!}
        </div>
        <!-- End Pager -->
    @else
        <h2>Відео отсутствуют</h2>
    @endif
@stop

@section('footer')
    @include('marketing.layout.footer')
@stop

@section('meta')
    <meta name="keywords" content="{{ $videos_description->page_keywords }}">
    <meta name="description" content="{{ trim($videos_description->page_description) != '' ? $videos_description->page_description : str_limit(strip_tags($videos_description->full_text), 200) }}">
@stop