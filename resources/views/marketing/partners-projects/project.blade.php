@extends('marketing.layout.master')

@section('page_title'){{ $project->title }}@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => 'Партнёры и объекты',
                'items' => [
                        ['title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE],
                        ['title' => 'Партнёры и объекты', 'action' => 'Marketing\PartnersProjectsController@index', 'active' => FALSE],
                        ['title' => $project->title, 'action' => '', 'active' => TRUE],
                ]
            ])
@stop

@section('content')

<!-- News v3 -->
<div class="news-v3">
    <div class="news-v3-in">
        <h2><a href="{{ route('project-action', ['slug' => $project->slug]) }}">{{ $project->title }}</a></h2>
        @if($project->description_full)
            {!! $project->description_full !!}
        @else
            {!! $project->description_short !!}
        @endif
    </div>
</div>
<!-- End News v3 -->

@stop

@section('footer')
    @include('marketing.layout.footer')
@stop