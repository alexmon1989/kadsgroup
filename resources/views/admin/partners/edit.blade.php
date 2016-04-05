@extends('admin.layout.master')

@section('top_content')
@include('admin.layout.breadcrumbs', [
            'title' => 'Редактирование партнёра',
            'items' => [
                    ['title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE],
                    ['title' => 'Партнёры и объекты', 'action' => '', 'active' => FALSE],
                    ['title' => $partner->title, 'action' => '', 'active' => TRUE],
            ]
        ])
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $partner->title }}</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <a href="{{ action('Admin\ProjectsController@getIndex') }}">Назад ко всем партнёрам</a>
        @include('admin.partners._form')
    </div><!-- /.box-body -->
    <div class="box-footer">
        <a href="{{ action('Admin\ProjectsController@getIndex') }}">Назад ко всем партнёрам</a>
    </div><!-- /.box-footer-->
</div><!-- /.box -->
@stop

@section('script')
<!-- CKEDITOR -->
<script src="{{ asset('assets/plugins/adminlte/plugins/ckeditor/ckeditor.js') }}"></script>
@stop