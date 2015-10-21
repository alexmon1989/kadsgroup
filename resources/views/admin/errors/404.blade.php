@extends('admin.layout.master')

@section('top_content')
@include('admin.layout.breadcrumbs', [
            'title' => '404 Ошибка',
            'items' => array(
                    array('title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE),
                    array('title' => '404', 'action' => '', 'active' => TRUE),
            )
        ])
@stop

@section('content')
<div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Ошибка! Страница не найдена.</h3>
        <p>
        Страница отсутствует. <br/>
        Вы можете вернуться на <a href='{{ action('Admin\DashboardController@getIndex') }}'>страницу начала работы</a> или какую-либо еще из меню слева.
        </p>
    </div><!-- /.error-content -->
</div><!-- /.error-page -->
@stop