@extends('marketing.layout.master')

@section('page_title')Партнёры и объекты@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => 'Партнёры и объекты',
                'items' => [
                        ['title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE],
                        ['title' => 'Партнёры и объекты', 'action' => '', 'active' => TRUE],
                ]
            ])
@stop

@section('content')
    <!-- Tab v2 -->
    <div class="tab-v2">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#partners" data-toggle="tab">Партнёры</a></li>
            <li><a href="#projects" data-toggle="tab">Объекты</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="partners">
                <div class="row">
                    <div class="col-md-12">
                        @if(count($partners) > 0)
                            @foreach($partners as $partner)
                                <!-- Clients Block-->
                                <div class="row clients-page">
                                    <div class="col-md-2">
                                        @if($partner->image)
                                        <img src="{{ asset('assets/img/partners/'.$partner->image) }}" class="img-responsive hover-effect" alt="{{ $partner->title }}" />
                                        @else
                                        <img src="{{ asset('assets/img/partners/no_photo.jpg') }}" class="img-responsive hover-effect" alt="" />
                                        @endif
                                    </div>
                                    <div class="col-md-10">
                                        <h3>{{ $partner->title }}</h3>
                                        @if($partner->web_site || $partner->category)
                                            <ul class="list-inline">
                                                @if($partner->web_site)
                                                <li><i class="fa fa-globe color-green"></i> <a class="linked" href="http://{{ $partner->web_site }}" target="_blank">{{ $partner->web_site }}</a></li>
                                                @endif
                                                @if($partner->category)
                                                <li><i class="fa fa-briefcase color-green"></i> {{ $partner->category }}</li>
                                                @endif
                                            </ul>
                                        @endif
                                        {!! $partner->description !!}
                                    </div>
                                </div>
                                <!-- End Clients Block-->
                            @endforeach
                        @else
                            <p>Пока что партнёры отсутствуют. Для сотрудничества <a href="{{ action('Marketing\ContactsController@getIndex') }}">свяжитесь с нами</a>.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="tab-pane fade in" id="projects">
                <div class="row">
                    <div class="col-md-12">
                        @if(count($projects) > 0)
                            @foreach($projects as $project)
                            <!-- Clients Block-->
                            <div class="row clients-page">
                                <div class="col-md-2">
                                    @if($project->image)
                                        <img src="{{ asset('assets/img/projects/'.$project->image) }}" class="img-responsive hover-effect" alt="{{ $project->title }}" />
                                    @else
                                        <img src="{{ asset('assets/img/projects/no_photo.jpg') }}" class="img-responsive hover-effect" alt="" />
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <h3><a href="{{ route('project-action', ['slug' => $project->slug]) }}">{{ $project->title }}</a></h3>
                                    {!! $project->description_short !!}
                                </div>
                            </div>
                            <!-- End Clients Block-->
                            @endforeach
                        @else
                            <p>Пока что объекты отсутствуют. Для сотрудничества <a href="{{ action('Marketing\ContactsController@getIndex') }}">свяжитесь с нами</a>.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Tab v2 -->
@stop

@section('footer')
    @include('marketing.layout.footer')
@stop

@section('styles')
<link rel="stylesheet" href="assets/css/pages/page_clients.css">
@stop