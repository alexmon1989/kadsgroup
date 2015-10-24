@extends('marketing.layout.master')

@section('page_title')
Відео "Праймер"
@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => 'Відео "Праймер"',
                'items' => array(
                        array('title' => 'Головна', 'action' => 'Marketing\HomeController@index', 'active' => FALSE),
                        array('title' => 'Відео "Праймер"', 'action' => '', 'active' => TRUE),
                )
            ])
@stop

@section('content')
    @if (!empty($videos))

        @if ($videos_description->title != '' && $videos_description->full_text != '')
        <div class="text-center margin-bottom-50">
            @if ($videos_description->title != '')<h2 class="title-v2 title-center text-uppercase">{{ $videos_description->title }}</h2>@endif
            @if ($videos_description->full_text != '')<p class="space-lg-hor">{!! $videos_description->full_text !!}</p>@endif
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
        <h2>Відео відсутні</h2>
    @endif
@stop

@section('footer')
    @include('marketing.layout.footer')
@stop