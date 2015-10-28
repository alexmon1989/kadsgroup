@extends('admin.layout.master')

@section('top_content')
    @include('admin.layout.breadcrumbs', [
                'title' => 'Товары Sika',
                'items' => [
                        [ 'title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE ],
                        [ 'title' => 'Компании', 'action' => '', 'active' => FALSE ],
                        [ 'title' => 'Sika', 'action' => '', 'active' => FALSE ],
                        [ 'title' => 'Товары', 'action' => '', 'active' => TRUE ],
                ]
            ])
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Выбирайте товар для редактирования или создайте новый</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <p>
                <a class="btn btn-primary" href="{{ action('Admin\Companies\Catalog\Products\SikaController@getCreate') }}"><i class="fa fa-plus"></i> Создать</a>
            </p>

            <table id="data-products" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Категория</th>
                        <th>Включено</th>
                        <th>Создано</th>
                        <th>Последнее редактирование</th>
                        <th>Действия</th>
                    </tr>
                </thead>
            </table>

        </div><!-- /.box-body -->
        <div class="box-footer">

        </div><!-- /.box-footer-->
    </div><!-- /.box -->
@stop

@push('script')
<script>
    $(function() {
        $('#data-products').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('datatables.data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'category', name: 'category' },
                { data: 'enabled', name: 'enabled' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            stateSave: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.7/i18n/Russian.json'
            }
        });
    });
</script>
@endpush