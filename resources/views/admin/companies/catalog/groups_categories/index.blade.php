@extends('admin.layout.master')

@section('top_content')
    @include('admin.layout.breadcrumbs', [
                'title' => 'Группы категорий',
                'items' => [
                        [ 'title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE],
                        [ 'title' => 'Компании', 'action' => '', 'active' => FALSE ],
                        [ 'title' => $company->title, 'action' => '', 'active' => FALSE ],
                        [ 'title' => 'Группы категорий', 'action' => '', 'active' => TRUE ],
                ]
            ])
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Выбирайте группу категорий для редактирования или создайте новую</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <p>
                <a class="btn btn-primary" href="{{ action('Admin\Companies\Catalog\GroupsCategoriesController@getCreate') }}?company={{ $company->short_title }}"><i class="fa fa-plus"></i> Создать</a>
            </p>
            <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Включено</th>
                    <th>Позиция</th>
                    <th>Создано</th>
                    <th>Последнее редактирование</th>
                    <th>Действия</th>
                </tr>
                </thead>

                <tbody>
                @foreach($groups_categories as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{!! $item->enabled == TRUE ? '<strong>Да</strong>' : 'Нет' !!}</td>
                        <td>
                            {{ $item->order }}
                            <a href="{{ action('Admin\Companies\Catalog\GroupsCategoriesController@getDecreasePosition', array('id' => $item->id)) }}?company={{ $company->short_title }}" title="Поднять наверх"><i class="fa fa-toggle-up"></i></a>
                            <a href="{{ action('Admin\Companies\Catalog\GroupsCategoriesController@getIncreasePosition', array('id' => $item->id)) }}?company={{ $company->short_title }}" title="Опустить вниз"><i class="fa fa-toggle-down"></i></a>
                        </td>
                        <td>{{ date('d.m.Y H:i:s', strtotime($item->created_at)) }}</td>
                        <td>{{ date('d.m.Y H:i:s', strtotime($item->updated_at)) }}</td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-primary btn-sm" href="{{ action('Admin\Companies\Catalog\GroupsCategoriesController@getEdit', array('id' => $item->id)) }}?company={{ $company->short_title }}" title="Редактировать"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm item-delete" href="{{ action('Admin\Companies\Catalog\GroupsCategoriesController@getDelete', array('id' => $item->id)) }}?company={{ $company->short_title }}" title="Удалить"><i class="fa fa-remove"></i></a>
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