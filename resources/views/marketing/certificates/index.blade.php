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
                        array('title' => 'Сертифікати', 'action' => '', 'active' => TRUE),
                )
            ])
@stop

@section('content')
    @if (!empty($certificates))

        @if ($certificates_description->title != '' && $certificates_description->full_text != '')
        <div class="text-center margin-bottom-50">
            @if ($certificates_description->title != '')<h2 class="title-v2 title-center text-uppercase">{{ $certificates_description->title }}</h2>@endif
            @if ($certificates_description->full_text != '')<p class="space-lg-hor">{!! $certificates_description->full_text !!}</p>@endif
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
        <h2>Сертифікати відсутні</h2>
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