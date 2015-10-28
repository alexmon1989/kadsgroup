@extends('admin.layout.master')

@section('top_content')
    @include('admin.layout.breadcrumbs', [
                'title' => 'Категории',
                'items' => [
                        [ 'title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE],
                        [ 'title' => 'Компании', 'action' => '', 'active' => FALSE ],
                        [ 'title' => $company->title, 'action' => '', 'active' => FALSE ],
                        [ 'title' => 'Редактирование категории '.$category->title, 'action' => '', 'active' => TRUE ],
                ]
            ])
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ 'Редактирование категории '.$category->title }}</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        @include('admin.companies.catalog.categories._form')
    </div><!-- /.box-body -->
    <div class="box-footer">
        <a href="{{ action('Admin\Companies\Catalog\CategoriesController@getIndex') }}?company={{ $company->short_title }}">Назад ко всем категориям</a>
    </div><!-- /.box-footer-->
</div><!-- /.box -->
@stop

@section('script')
    <!-- CKEDITOR -->
    <script src="{{ asset('assets/plugins/adminlte/plugins/ckeditor/ckeditor.js') }}"></script>
@stop