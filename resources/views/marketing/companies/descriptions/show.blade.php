@extends('marketing.layout.master')

@section('page_title')
{{ $company->title }}
@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => $company->title,
                'items' => [
                        ['title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE],
                        ['title' => 'Группа компаний', 'action' => '', 'active' => FALSE],
                        ['title' => $company->title, 'action' => '', 'active' => FALSE],
                        ['title' => 'О компании', 'action' => '', 'active' => TRUE],
                ]
            ])
@stop

@section('content')
<div class="row margin-bottom-20 margin-top-20">
    <div class="col-md-12">
        {!! $company->description !!}
    </div>
</div>
@stop