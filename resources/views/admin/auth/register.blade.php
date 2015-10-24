@extends('admin.layout.master')

@section('top_content')
@include('admin.layout.breadcrumbs', [
            'title' => 'Список пользователей (администраторов)',
            'items' => array(
                    array('title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE),
                    array('title' => 'Список пользователей (администраторов)', 'action' => 'Auth\AuthController@getList', 'active' => FALSE),
                    array('title' => 'Регистрация пользователя', 'action' => '', 'active' => TRUE),
            )
        ])
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Регистрация пользователя</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        @include('admin.auth._form')
    </div><!-- /.box-body -->
    <div class="box-footer">
        <a href="{{ action('Auth\AuthController@getList') }}">Назад ко всем пользователям</a>
    </div><!-- /.box-footer-->
</div><!-- /.box -->
@stop