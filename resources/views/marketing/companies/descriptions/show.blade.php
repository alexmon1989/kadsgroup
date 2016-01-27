@extends('marketing.layout.master')

@section('page_title'){{ $company->page_title != '' ? $company->page_title : $company->title }}@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => $company->page_h1 != '' ? $company->page_h1 : $company->title,
                'items' => [
                        ['title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE],
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

@section('meta')
    <meta name="keywords" content="{{ $company->page_keywords }}">
    <meta name="description" content="{{ trim($company->page_description) != '' ? $company->page_description : str_limit(strip_tags($company->full_text), 200) }}">
@stop