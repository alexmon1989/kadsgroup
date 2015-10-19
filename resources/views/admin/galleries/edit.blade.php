@extends('admin.layout.master')

@section('top_content')
@include('admin.layout.breadcrumbs', [
            'title' => 'Редактирование фотографии',
            'items' => array(
                    array('title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE),
                    array('title' => 'Фотогалерея "'.$photo->company->title.'"', 'action' => 'Admin\GalleriesController@getIndex', 'action_params' => ['company' => $photo->company->short_title], 'active' => FALSE),
                    array('title' => $photo->title, 'action' => '', 'active' => TRUE),
            )
        ])
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $photo->title }}</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        @include('admin.galleries._form_gallery')
    </div><!-- /.box-body -->
    <div class="box-footer">
        <a href="{{ action('Admin\GalleriesController@getIndex', ['company' => $photo->company->short_title]) }}">Назад ко всем фотографиям</a>
    </div><!-- /.box-footer-->
</div><!-- /.box -->
@stop