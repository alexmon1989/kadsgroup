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
                <a href="{{ action('Auth\AuthController@getEdit', ['id' => $auser->id]) }}"><i class="fa fa-circle text-success"></i> Online</a>
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

            <li class="{{ Request::segment(2) == 'sliders' ? 'active' : '' }}">
                <a href="{{ action('Admin\SliderController@getIndex') }}">
                    <i class="fa fa-sliders"></i> <span>Слайдер</span>
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

            <li class="{{ Request::segment(2) == 'galleries' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-photo"></i> <span>Фотогалерея</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::segment(2) == 'galleries' && Request::get('company') == 'sika' ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Sika <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::segment(2) == 'galleries' && Request::get('company') == 'sika' && (Request::segment(3) == 'create' || Request::segment(3) == 'edit' || Request::segment(3) == '') ? 'active' : '' }}">
                                <a href="{{ action('Admin\GalleriesController@getIndex', ['company' => 'sika']) }}">
                                    <i class="fa fa-circle-o"></i> Список фото
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) == 'galleries' && Request::get('company') == 'sika' && Request::segment(3) == 'settings' ? 'active' : '' }}">
                                <a href="{{ action('Admin\GalleriesController@getSettings') }}?company=sika">
                                    <i class="fa fa-circle-o"></i> Настройки
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Request::segment(2) == 'galleries' && Request::get('company') == 'sfs' ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-circle-o"></i> SFS intec <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::segment(2) == 'galleries' && Request::get('company') == 'sfs' && (Request::segment(3) == 'create' || Request::segment(3) == 'edit' || Request::segment(3) == '') ? 'active' : '' }}">
                                <a href="{{ action('Admin\GalleriesController@getIndex', ['company' => 'sfs']) }}">
                                    <i class="fa fa-circle-o"></i> Список фото
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) == 'galleries' && Request::get('company') == 'sfs' && Request::segment(3) == 'settings' ? 'active' : '' }}">
                                <a href="{{ action('Admin\GalleriesController@getSettings') }}?company=sfs">
                                    <i class="fa fa-circle-o"></i> Настройки
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Request::segment(2) == 'galleries' && Request::get('company') == 'primer' ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Праймер <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::segment(2) == 'galleries' && Request::get('company') == 'primer' && (Request::segment(3) == 'create' || Request::segment(3) == 'edit' || Request::segment(3) == '') ? 'active' : '' }}">
                                <a href="{{ action('Admin\GalleriesController@getIndex', ['company' => 'primer']) }}">
                                    <i class="fa fa-circle-o"></i> Список фото
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) == 'galleries' && Request::get('company') == 'primer' && Request::segment(3) == 'settings' ? 'active' : '' }}">
                                <a href="{{ action('Admin\GalleriesController@getSettings') }}?company=primer">
                                    <i class="fa fa-circle-o"></i> Настройки
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

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

            <li class="{{ Request::segment(2) == 'companies' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-dollar"></i> <span>Компании</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::segment(2) == 'companies' && Request::get('company') == 'sika' ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Sika <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::segment(2) == 'companies' && Request::segment(3) == 'descriptions' && Request::get('company') == 'sika' ? 'active' : '' }}">
                                <a href="{{ action('Admin\Companies\DescriptionsController@getIndex', ['company' => 'sika']) }}">
                                    <i class="fa fa-circle-o"></i> Описание
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) == 'companies' && Request::segment(3) == 'catalog' && Request::get('company') == 'sika' ? 'active' : '' }}">
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> Каталог <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="{{ Request::segment(2) == 'companies' && Request::segment(3) == 'catalog' && Request::segment(4) == 'groups-categories' && Request::get('company') == 'sika' ? 'active' : '' }}">
                                        <a href="{{ action('Admin\Companies\Catalog\GroupsCategoriesController@getIndex', ['company' => 'sika']) }}">
                                            <i class="fa fa-circle-o"></i> Групы категорий
                                        </a>
                                    </li>
                                    <li class="{{ Request::segment(2) == 'companies' && Request::segment(3) == 'catalog' && Request::segment(4) == 'categories' && Request::get('company') == 'sika' ? 'active' : '' }}">
                                        <a href="{{ action('Admin\Companies\Catalog\CategoriesController@getIndex', ['company' => 'sika']) }}">
                                            <i class="fa fa-circle-o"></i> Категории
                                        </a>
                                    </li>
                                    <li class="{{ Request::segment(2) == 'companies' && Request::segment(3) == 'catalog' && Request::segment(4) == 'products' && Request::get('company') == 'sika' ? 'active' : '' }}">
                                        <a href="{{ action('Admin\Companies\Catalog\Products\SikaController@getIndex') }}">
                                            <i class="fa fa-circle-o"></i> Товары
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Request::segment(2) == 'companies' && Request::get('company') == 'sfs' ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-circle-o"></i> SFS intent <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::segment(2) == 'companies' && Request::segment(3) == 'descriptions' && Request::get('company') == 'sfs' ? 'active' : '' }}">
                                <a href="{{ action('Admin\Companies\DescriptionsController@getIndex', ['company' => 'sfs']) }}">
                                    <i class="fa fa-circle-o"></i> Описание
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) == 'companies' && Request::segment(3) == 'sfs' && Request::segment(4) == 'catalog' ? 'active' : '' }}">
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> Каталог
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Request::segment(2) == 'companies' && (Request::segment(3) == 'primer' || Request::get('company') == 'primer') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Праймер <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::segment(2) == 'companies' && Request::segment(3) == 'descriptions' && Request::get('company') == 'primer' ? 'active' : '' }}">
                                <a href="{{ action('Admin\Companies\DescriptionsController@getIndex', ['company' => 'primer']) }}">
                                    <i class="fa fa-circle-o"></i> Описание
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) == 'companies' && Request::get('company') == 'primer' && Request::segment(3) == 'prices' ? 'active' : '' }}">
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> Прайс-лист
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) == 'companies' && Request::segment(3) == 'primer' && Request::segment(4) == 'videos' ? 'active' : '' }}">
                                <a href="#">
                                    <i class="fa fa-video-camera"></i> <span>Видео</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="{{ Request::segment(2) == 'companies' && Request::segment(3) == 'primer' && Request::segment(4) == 'videos' && (Request::segment(5) == 'create' || Request::segment(5) == 'edit' || Request::segment(5) == '') ? 'active' : '' }}">
                                        <a href="{{ action('Admin\VideosController@getIndex') }}">
                                            <i class="fa fa-circle-o"></i> Список видео
                                        </a>
                                    </li>
                                    <li class="{{ Request::segment(2) == 'companies' && Request::segment(3) == 'primer' && Request::segment(4) == 'videos' && Request::segment(5) == 'settings' ? 'active' : '' }}">
                                        <a href="{{ action('Admin\VideosController@getSettings') }}">
                                            <i class="fa fa-circle-o"></i> Настройки
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{ Request::segment(2) == 'companies' && Request::segment(3) == 'primer' && Request::segment(4) == 'catalog' ? 'active' : '' }}">
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> Каталог
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!--<li class="{{ Request::segment(2) == 'videos' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-video-camera"></i> <span>Видео</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::segment(2) == 'videos' && (Request::segment(3) == 'create' || Request::segment(3) == 'edit' || Request::segment(3) == '') ? 'active' : '' }}">
                        <a href="{{ action('Admin\VideosController@getIndex') }}">
                            <i class="fa fa-circle-o"></i> Список видео
                        </a>
                    </li>
                    <li class="{{ Request::segment(2) == 'videos' && Request::segment(3) == 'settings' ? 'active' : '' }}">
                        <a href="{{ action('Admin\VideosController@getSettings') }}">
                            <i class="fa fa-circle-o"></i> Настройки
                        </a>
                    </li>
                </ul>
            </li>-->
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