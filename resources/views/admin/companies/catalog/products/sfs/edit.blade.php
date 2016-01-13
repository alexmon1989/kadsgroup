@extends('admin.layout.master')

@section('top_content')
@include('admin.layout.breadcrumbs', [
            'title' => 'Редактирование товара Sfs',
            'items' => [
                    ['title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE ],
                    [ 'title' => 'Компании', 'action' => '', 'active' => FALSE ],
                    [ 'title' => 'Sfs', 'action' => '', 'active' => FALSE ],
                    [ 'title' => 'Редактирование товара '.$product->title, 'action' => '', 'active' => TRUE ],
            ]
        ])
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $product->title }}</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <a href="{{ action('Admin\Companies\Catalog\Products\SfsController@getIndex') }}">Назад ко всем продуктам</a>
        @include('admin.companies.catalog.products.sfs._form')
    </div><!-- /.box-body -->
    <div class="box-footer">
        <a href="{{ action('Admin\Companies\Catalog\Products\SfsController@getIndex') }}">Назад ко всем продуктам</a>
    </div><!-- /.box-footer-->
</div><!-- /.box -->
@stop

@section('script')
<!-- CKEDITOR -->
<script src="{{ asset('assets/plugins/adminlte/plugins/ckeditor/ckeditor.js') }}"></script>
@stop