<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('assets/plugins/adminlte/dist/img/avatar.png') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ $auser->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Меню</li>
            <li class="{{ Request::segment(2) == 'dashboard' || Request::segment(2) == '' ? 'active' : '' }}">
                <a href="{{ action('Admin\DashboardController@getIndex') }}">
                    <i class="fa fa-dashboard"></i> <span>Начало работы</span>
                </a>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li class="header">Ссылки</li>
            <li>
                <a href="{{ action('Marketing\HomeController@index') }}" title="Открыть в новой вкладке" target="_blank">
                    <i class="fa fa-external-link"></i> <span>Перейти на сайт</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>