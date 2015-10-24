@extends('admin.layout.master')

@section('top_content')
    @include('admin.layout.breadcrumbs', [
                'title' => 'Фотогалерея',
                'items' => array(
                        array('title' => 'Начало работы', 'action' => 'Admin\DashboardController@getIndex', 'active' => FALSE),
                        array('title' => 'Настройки страницы "Фотогалерея'.$companyName.'"', 'action' => '', 'active' => TRUE),
                )
            ])
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Настройки страницы "Фотогалерея {{ $companyName }}"</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="callout callout-info">
            <h4>Информация!</h4>
            <p>Здесь Вы можете настроить текст, который будет отображаться над фотографиями. При желании, Вы можете оставить какое-то одно или оба поля пустыми.</p>
        </div>
        @include('admin.galleries._form_settings', ['companyNameShort' => $companyNameShort])
    </div><!-- /.box-body -->
    <div class="box-footer">

    </div><!-- /.box-footer-->
</div><!-- /.box -->
@stop

@section('script')
    <!-- CKEDITOR -->
    <script src="{{ asset('assets/plugins/adminlte/plugins/ckeditor/ckeditor.js') }}"></script>
@stop