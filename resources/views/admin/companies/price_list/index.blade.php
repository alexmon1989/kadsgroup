@extends('admin.layout.master')

@section('top_content')
@include('admin.layout.breadcrumbs', [
            'title' => 'Прайс-лист компании',
            'items' => [
                    ['title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE],
                    ['title' => 'Компании', 'action' => '', 'active' => FALSE],
                    ['title' => 'Обновление прайс-листа компании "'.$company->title.'"', 'action' => '', 'active' => TRUE],
            ]
        ])
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Обновление прайс-листа компании "{{ $company->title }}"</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        @if ($last_update != 'Никогда')
        <p>Ссылка на текущий файл: <a href="{{ asset('assets/price-list/'.$file_name) }}" target="_blank">Скачать</a></p>
        @endif
        <p>Последнее обновление прайс-листа: <strong>{{ $last_update }}</strong></p>

        @include('admin.companies.price_list._form')
    </div><!-- /.box-body -->
    <div class="box-footer">

    </div><!-- /.box-footer-->
</div><!-- /.box -->
@stop