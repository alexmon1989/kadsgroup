@extends('admin.layout.master')

@section('top_content')
@include('admin.layout.breadcrumbs', [
            'title' => 'Редактирование видео',
            'items' => array(
                    array('title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE),
                    array('title' => 'Видео', 'action' => 'Admin\VideosController@getIndex', 'active' => FALSE),
                    array('title' => $video->youtube_id, 'action' => '', 'active' => TRUE),
            )
        ])
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $video->youtube_id }}</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video->youtube_id }}" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        @include('admin.videos._form_video')
    </div><!-- /.box-body -->
    <div class="box-footer">
        <a href="{{ action('Admin\VideosController@getIndex') }}">Назад ко всем видео</a>
    </div><!-- /.box-footer-->
</div><!-- /.box -->
@stop