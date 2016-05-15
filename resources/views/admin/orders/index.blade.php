@extends('admin.layout.master')

@section('top_content')
@include('admin.layout.breadcrumbs', [
            'title' => 'Список заказов',
            'items' => [
                    [ 'title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE ],
                    [ 'title' => 'Заказы', 'action' => '', 'active' => TRUE ],
            ]
        ])
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Выбирайте заказ для редактирования</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ФИО заказчика</th>
                        <th>Компания</th>
                        <th>E-Mail</th>
                        <th>Телефон</th>
                        <th>Продукт</th>
                        <th>Статус</th>
                        <th>Создано</th>
                        <th>Последнее редактирование</th>
                        <th>Действия</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->company }}</td>
                        <td><a href="mailto:{{ $item->email }}">{{ $item->email }}</a></td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->product_title }}</td>
                        <td>
                            @if($item->status == 1)
                            <span class="label label-danger">Новый</span>
                            @elseif($item->status == 2)
                            <span class="label label-warning">В обработке</span>
                            @else
                            <span class="label label-success">Обработан</span>
                            @endif
                        </td>
                        <td>{{ date('d.m.Y H:i:s', strtotime($item->created_at)) }}</td>
                        <td>{{ date('d.m.Y H:i:s', strtotime($item->updated_at)) }}</td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-primary btn-sm" href="{{ route('orders.edit', ['order' => $item]) }}" title="Редактировать"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm item-delete" href="{{ route('orders.delete', ['order' => $item]) }}" title="Удалить"><i class="fa fa-remove"></i></a>
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