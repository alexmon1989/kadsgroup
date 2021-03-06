@extends('marketing.layout.master')

@section('page_title'){{ $article->page_title != '' ? $article->page_title  : 'Фотогалерея "'.$company->title.'"' }}{{ $photos->currentPage() != 1 ? ' - Страница ' . $photos->currentPage() : '' }}@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => $article->page_h1 != '' ? $article->page_h1  : 'Фотогалерея "'.$company->title.'"',
                'items' => array(
                        array('title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE),
                        array('title' => 'Фотогалерея "'.$company->title.'"', 'action' => '', 'active' => TRUE),
                )
            ])
@stop

@section('content')
    @if (count($photos))

        @if ($article->title != '' || $article->full_text != '')
            <div class="text-center margin-bottom-50">
                @if ($article->title != '')
                    <h2 class="{{ $article->full_text != '' ? 'title-v2 ' : '' }}title-center text-uppercase">{{ $article->title }}</h2>
                @endif
                @if ($article->full_text != '')
                    {!! $article->full_text !!}
                @endif
            </div>
        @endif

        @for($i = 0; $i <= count($photos) - 1; $i += 3)
            <div class="row margin-bottom-30">
                @for($j = 0; $j <= 2; $j++)
                    @if (isset($photos[$i+$j]))
                    <div class="col-sm-4 sm-margin-bottom-30">
                        <a href="{{ asset('assets/img/galleries/'.$photos[$i+$j]->file_name) }}" rel="gallery1" class="fancybox img-hover-v1" title="{{ $photos[$i+$j]->title }}">
                            <span><img class="img-responsive" src="{{ asset('assets/img/galleries/'.$photos[$i+$j]->file_name) }}" alt="{{ $photos[$i+$j]->title }}"></span>
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
        <h2>Фотографии отсутствуют</h2>
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


@section('meta')
    <meta name="keywords" content="{{ $article->page_keywords }}">
    <meta name="description" content="{{ trim($article->page_description) != '' ? $article->page_description : str_limit(strip_tags($article->full_text), 200) }}">

    @if ($photos->currentPage() == 1)
    <link rel="canonical" href="{{ url('galleries/show/' . $company->short_title) }}"/>
    @endif

    @if ($photos->currentPage() < $photos->lastPage())
    <link rel="next" href="{{ url('galleries/show/' . $company->short_title . '?page=' . ($products->currentPage() + 1)) }}" />
    @endif

    @if ($photos->currentPage() > 1)
    <link rel="prev" href="{{ url('galleries/show/' . $company->short_title . '?page=' . ($products->currentPage() - 1)) }}" />
    @endif
@stop