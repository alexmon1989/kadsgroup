@extends('marketing.layout.master')

@section('companies')
    @include('marketing.home._companies')
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 margin-top-20">
            {!! $article->full_text !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Новини</h2>
        </div>
    </div>

    <div class="row news-main">
        @foreach($news as $item)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="thumbnails thumbnail-style">
                    <img alt="{{ $item->title }}" src="{{ asset('assets/img/news/'.$item->thumbnail) }}" class="img-responsive">
                    <div class="caption">
                        <h3><a href="{{ action('Marketing\NewsController@getShow', ['id' => $item->id]) }}" class="hover-effect">{{ $item->title }}</a></h3>
                        <p>{!! $item->preview_text_small !!}</p>
                        <p><a class="btn-u btn-u-xs" href="{{ action('Marketing\NewsController@getShow', ['id' => $item->id]) }}">Детальніше <i class="fa fa-angle-right margin-left-5"></i></a></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop

@section('footer')
    @include('marketing.layout.footer_main')
@stop

@section('scripts')
    <script type="text/javascript" src="assets/js/forms/contact.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            ContactForm.initContactForm();
        });
    </script>
@stop