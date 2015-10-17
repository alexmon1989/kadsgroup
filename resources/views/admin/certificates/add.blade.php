@extends('admin.layout.master')

@section('top_content')
@include('admin.layout.breadcrumbs', [
            'title' => 'Создание сертификата',
            'items' => array(
                    array('title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE),
                    array('title' => 'Сертификаты', 'action' => 'Admin\CertificatesController@getIndex', 'active' => FALSE),
                    array('title' => 'Создание сертификата', 'action' => '', 'active' => TRUE),
            )
        ])
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Создание сертификата</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        @include('admin.certificates._form_certificate')
    </div><!-- /.box-body -->
    <div class="box-footer">
        <a href="{{ action('Admin\CertificatesController@getIndex') }}">Назад ко всем сертификатам</a>
    </div><!-- /.box-footer-->
</div><!-- /.box -->
@stop