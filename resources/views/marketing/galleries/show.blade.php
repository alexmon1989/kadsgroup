@extends('marketing.layout.master')

@section('page_title')
Сертифікати
@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => 'Сертифікати',
                'items' => array(
                        array('title' => 'Головна', 'action' => 'Marketing\HomeController@index', 'active' => FALSE),
                        array('title' => 'Фотогалереї', 'action' => '', 'active' => TRUE),
                )
            ])
@stop

@section('content')
    @if (!empty($photos))

        @if ($article->title != '' && $article->full_text != '')
        <div class="text-center margin-bottom-50">
            @if ($article->title != '')<h2 class="title-v2 title-center text-uppercase">{{ $article->title }}</h2>@endif
            @if ($article->full_text != '')<p class="space-lg-hor">{!! $article->full_text !!}</p>@endif
        </div>
        @endif

        @for($i = 0; $i <= count($photos) - 1; $i += 3)
            <div class="row margin-bottom-30">
                @for($j = 0; $j <= 2; $j++)
                    @if (isset($photos[$i+$j]))
                    <div class="col-sm-4 sm-margin-bottom-30">
                        <a href="{{ asset('assets/img/certificates/'.$photos[$i+$j]->file_name) }}" rel="gallery1" class="fancybox img-hover-v1" title="{{ $photos[$i+$j]->title }}">
                            <span><img class="img-responsive" src="{{ asset('assets/img/certificates/'.$photos[$i+$j]->file_name) }}" alt="{{ $photos[$i+$j]->title }}"></span>
                        </a>
                    </div>
                    @endif
                @endfor
            </div>
        @endfor

        <!-- Pager -->
        <div class="text-center">
            {!! str_replace('/?', '?', $photos->render()) !!}
        </div>
        <!-- End Pager -->
    @else
        <h2>Фотографії відсутні</h2>
    @endif
@stop

@section('footer')
    @include('marketing.layout.footer')
@stop

@section('styles')
    <link rel="stylesheet" href="assets/plugins/fancybox/source/jquery.fancybox.css">
@stop

@section('scripts')
    <script type="text/javascript" src="assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="assets/js/plugins/fancy-box.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            FancyBox.initFancybox();
        });
    </script>
@stop