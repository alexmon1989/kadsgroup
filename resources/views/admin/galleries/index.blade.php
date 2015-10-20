@extends('admin.layout.master')

@section('top_content')
@include('admin.layout.breadcrumbs', [
            'title' => 'Фотогалерея',
            'items' => array(
                    array('title' => 'Начало работы', 'action' => 'Admin\GalleriesController@getIndex', 'active' => FALSE),
                    array('title' => 'Фотогалерея '. $companyName, 'action' => '', 'active' => TRUE),
            )
        ])
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Управление фотографиями фотогалереи компании {{ $companyName }}</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <p>
            <a class="btn btn-primary" href="{{ action('Admin\GalleriesController@getCreate') }}?company={{ $companyNameShort }}"><i class="fa fa-plus"></i> Создать</a>
        </p>
        <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Изображение</th>
                <th>Создано</th>
                <th>Последнее редактирование</th>
                <th>Действия</th>
            </tr>
            </thead>

            <tbody>
            @foreach($photos as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td><img class="img-responsive" width="100" alt="{{ $item->title }}" src="{{ asset('assets/img/galleries/'.$item->file_name) }}"></td>
                    <td>{{ date('d.m.Y H:i:s', strtotime($item->created_at)) }}</td>
                    <td>{{ date('d.m.Y H:i:s', strtotime($item->updated_at)) }}</td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-primary btn-sm" href="{{ action('Admin\GalleriesController@getEdit', array('id' => $item->id)) }}?company={{ $companyNameShort }}" title="Редактировать"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm item-delete" href="{{ action('Admin\GalleriesController@getDelete', array('id' => $item->id)) }}?company={{ $companyNameShort }}" title="Удалить"><i class="fa fa-remove"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div><!-- /.box-body -->
    <div class="box-footer">

    </div><!-- /.box-footer-->
</div><!-- /.box -->
@stop