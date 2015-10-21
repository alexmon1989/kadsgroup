@extends('marketing.layout.master')

@section('page_title')
{{ $company->title }}
@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => $company->title,
                'items' => array(
                        array('title' => 'Головна', 'action' => 'Marketing\HomeController@index', 'active' => FALSE),
                        array('title' => $company->title, 'action' => '', 'active' => TRUE),
                )
            ])
@stop

@section('content')
<div class="row margin-bottom-20 margin-top-20">
    <div class="col-md-12">
        {!! $company->description !!}
    </div>
</div>
@stop