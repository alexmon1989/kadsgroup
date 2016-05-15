@extends('admin.layout.master')

@section('top_content')
@include('admin.layout.breadcrumbs', [
            'title' => 'Редактирование заказа',
            'items' => [
                    [ 'title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE ],
                    [ 'title' => 'Заказы', 'action' => 'Admin\NewsController@getIndex', 'active' => FALSE ],
                    [ 'title' => 'Редактирование заказа', 'action' => '', 'active' => TRUE ],
            ]
        ])
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Редактирование заказа</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        @include('admin.orders._form')
    </div><!-- /.box-body -->
    <div class="box-footer">
        <a href="{{ route('orders.index') }}">Назад ко всем заказам</a>
    </div><!-- /.box-footer-->
</div><!-- /.box -->
@stop

@section('script')
<!-- CKEDITOR -->
<script src="{{ asset('assets/plugins/adminlte/plugins/ckeditor/ckeditor.js') }}"></script>
@stop