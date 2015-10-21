@extends('admin.layout.master')

@section('top_content')
@include('admin.layout.breadcrumbs', [
            'title' => 'Редактирование слайда',
            'items' => array(
                    array('title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE),
                    array('title' => 'Слайдер', 'action' => 'Admin\SliderController@getIndex', 'active' => FALSE),
                    array('title' => $slider->title, 'action' => '', 'active' => TRUE),
            )
        ])
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Редактирование слайда "{{ $slider->title }}"</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
            <div class="row">
                <div class="col-xs-10 col-md-5">
                    <img width="1000" src="{{ asset('img/sliders/'.$slider->file_name) }}" alt="" />
                </div>
            </div>

        @include('admin.slider._form')
    </div><!-- /.box-body -->
    <div class="box-footer">
        <a href="{{ action('Admin\SliderController@getIndex') }}">Назад ко всем слайдам</a>
    </div><!-- /.box-footer-->
</div><!-- /.box -->
@stop