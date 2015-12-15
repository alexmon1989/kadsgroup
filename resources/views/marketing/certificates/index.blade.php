@extends('marketing.layout.master')

@section('page_title')
{{ $certificates_description->page_title != '' ? $certificates_description->page_title  : 'Сертификаты' }}
@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => $certificates_description->page_h1 != '' ? $certificates_description->page_h1  : 'Сертификаты',
                'items' => [
                        ['title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE],
                        ['title' => 'Сертификаты', 'action' => '', 'active' => TRUE],
                ]
            ])
@stop

@section('content')
    @if (!empty($certificates))

        @if ($certificates_description->title != '' || $certificates_description->full_text != '')
            <div class="text-center margin-bottom-50">
                @if ($certificates_description->title != '')
                    <h2 class="{{ $certificates_description->full_text != '' ? 'title-v2 ' : '' }}title-center text-uppercase">{{ $certificates_description->title }}</h2>
                @endif
                @if ($certificates_description->full_text != '')
                    {!! $certificates_description->full_text !!}
                @endif
            </div>
        @endif

        @for($i = 0; $i <= count($certificates) - 1; $i += 3)
            <div class="row margin-bottom-30">
                @for($j = 0; $j <= 2; $j++)
                    @if (isset($certificates[$i+$j]))
                    <div class="col-sm-4 sm-margin-bottom-30">
                        <a href="{{ asset('assets/img/certificates/'.$certificates[$i+$j]->file_name) }}" rel="gallery1" class="fancybox img-hover-v1" title="{{ $certificates[$i+$j]->title }}">
                            <span><img class="img-responsive" src="{{ asset('assets/img/certificates/'.$certificates[$i+$j]->file_name) }}" alt="{{ $certificates[$i+$j]->title }}"></span>
                        </a>
                    </div>
                    @endif
                @endfor
            </div>
        @endfor


        <!-- Pager -->
        <div class="text-center">
            {!! str_replace('/?', '?', $certificates->render()) !!}
        </div>
        <!-- End Pager -->
    @else
        <h2>Сертификаты отсутствуют</h2>
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
    <meta name="keywords" content="{{ $certificates_description->page_keywords }}">
    <meta name="description" content="{{ trim($certificates_description->page_description) != '' ? $certificates_description->page_description : str_limit(strip_tags($certificates_description->full_text), 200) }}">
@stop