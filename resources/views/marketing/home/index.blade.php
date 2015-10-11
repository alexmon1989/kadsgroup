@extends('marketing.layout.master')

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

    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-124">
            <div class="thumbnails thumbnail-style">
                <img alt="" src="assets/img/news/1.jpg" class="img-responsive">
                <div class="caption">
                    <h3><a href="#" class="hover-effect">Новина перша</a></h3>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, justo sit amet risus etiam porta sem.</p>
                    <p><a class="btn-u btn-u-xs" href="#">Детальніше <i class="fa fa-angle-right margin-left-5"></i></a></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="thumbnails thumbnail-style">
                <img alt="" src="assets/img/news/2.jpg" class="img-responsive">
                <div class="caption">
                    <h3><a href="#" class="hover-effect">Новина друга</a></h3>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, justo sit amet risus etiam porta sem.</p>
                    <p><a class="btn-u btn-u-xs" href="#">Детальніше <i class="fa fa-angle-right margin-left-5"></i></a></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="thumbnails thumbnail-style">
                <img alt="" src="assets/img/news/3.jpg" class="img-responsive">
                <div class="caption">
                    <h3><a href="#" class="hover-effect">Новина третя</a></h3>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, justo sit amet risus etiam porta sem.</p>
                    <p><a class="btn-u btn-u-xs" href="#">Детальніше <i class="fa fa-angle-right margin-left-5"></i></a></p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    @include('marketing.layout.footer_main')
@stop