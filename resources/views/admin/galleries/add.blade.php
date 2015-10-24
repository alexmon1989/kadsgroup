@extends('admin.layout.master')

@section('top_content')
@include('admin.layout.breadcrumbs', [
            'title' => 'Создание фотографии',
            'items' => array(
                    array('title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE),
                    array('title' => 'Фотогалерея "'.$companyName.'"', 'action' => 'Admin\GalleriesController@getIndex', 'action_params' => ['company' => $companyNameShort], 'active' => FALSE),
                    array('title' => 'Создание фотографии', 'action' => '', 'active' => TRUE),
            )
        ])
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Создание фотографии</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        @include('admin.galleries._form_gallery')
    </div><!-- /.box-body -->
    <div class="box-footer">
        <a href="{{ action('Admin\GalleriesController@getIndex', ['company' => $companyNameShort]) }}">Назад ко всем фотографиям</a>
    </div><!-- /.box-footer-->
</div><!-- /.box -->
@stop