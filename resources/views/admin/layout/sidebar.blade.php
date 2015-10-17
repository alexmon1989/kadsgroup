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

            <li class="{{ Request::segment(2) == 'auth' ? 'active' : '' }}">
                <a href="{{ action('Auth\AuthController@getList') }}">
                    <i class="fa fa-users "></i> Пользователи (админы)
                </a>
            </li>

            <li class="{{ Request::segment(2) == 'settings' ? 'active' : '' }}">
                <a href="{{ action('Admin\SettingsController@getIndex') }}">
                    <i class="fa fa-wrench"></i> <span>Настройки</span>
                </a>
            </li>
        </ul>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Страницы</li>
            <li class="{{ Request::segment(2) == 'certificates' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-certificate"></i> <span>Сертификаты</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::segment(2) == 'certificates' && (Request::segment(3) == 'create' || Request::segment(3) == 'edit' || Request::segment(3) == '') ? 'active' : '' }}">
                        <a href="{{ action('Admin\CertificatesController@getIndex') }}">
                            <i class="fa fa-circle-o"></i> Список сертификатов
                        </a>
                    </li>
                    <li class="{{ Request::segment(2) == 'certificates' && Request::segment(3) == 'settings' ? 'active' : '' }}">
                        <a href="{{ action('Admin\CertificatesController@getSettings') }}">
                            <i class="fa fa-circle-o"></i> Настройки
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::segment(2) == 'news' ? 'active' : '' }}">
                <a href="{{ action('Admin\NewsController@getIndex') }}">
                    <i class="fa fa-newspaper-o"></i> <span>Новости</span>
                </a>
            </li>

            <li class="{{ Request::segment(2) == 'contacts' ? 'active' : '' }}">
                <a href="{{ action('Admin\ContactsController@getIndex') }}"><i class="fa fa-map-marker"></i> Контакты</a>
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