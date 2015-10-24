<div class="header no-topbar">
    <div class="container">
        <!-- Logo -->
        <a class="logo" href="{{ url() }}">
            <img src="{{ asset('assets/img/logo-kadsgroup.png') }}" alt="Логотип">
        </a>
        <!-- End Logo -->

        <!-- Toggle get grouped for better mobile display -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="fa fa-bars"></span>
        </button>
        <!-- End Toggle -->
    </div><!--/end container-->

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
        <div class="container">
            <ul class="nav navbar-nav">
                <!-- Верхнее меню -->
                <li class="dropdown {{ Request::segment(1) == 'companies' ? 'active' : '' }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Група компаній
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu {{ Request::segment(1) == 'companies' && Request::segment(2) == 'sika' ? 'active' : '' }}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sika</a>
                            <ul class="dropdown-menu">
                                <li class="{{ Request::segment(1) == 'companies'&& Request::segment(2) == 'sika' && Request::segment(3) == 'about'  ? 'active' : '' }}">
                                    <a href="{{ action('Marketing\Companies\AboutController@getShow', ['shortTitle' => 'sika']) }}">Про компанію</a>
                                </li>
                                <li>
                                    <a href="#">Каталог</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu {{ Request::segment(1) == 'companies' && Request::segment(2) == 'sfs' ? 'active' : '' }}">
                            <a href="#">SFS intec</a>
                            <ul class="dropdown-menu">
                                <li class="{{ Request::segment(1) == 'companies' && Request::segment(2) == 'sfs' && Request::segment(3) == 'about' ? 'active' : '' }}">
                                    <a href="{{ action('Marketing\Companies\AboutController@getShow', ['shortTitle' => 'sfs']) }}">Про компанію</a>
                                </li>
                                <li>
                                    <a href="#">Каталог</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu {{ Request::segment(1) == 'companies' && Request::segment(2) == 'primer' ? 'active' : '' }}">
                            <a href="#">Праймер</a>
                            <ul class="dropdown-menu">
                                <li class="{{ Request::segment(1) == 'companies' && Request::segment(2) == 'primer' && Request::segment(3) == 'about' ? 'active' : '' }}">
                                    <a href="{{ action('Marketing\Companies\AboutController@getShow', ['shortTitle' => 'primer']) }}">Про компанію</a>
                                </li>
                                <li>
                                    <a href="#">Каталог</a>
                                </li>
                                <li>
                                    <a target="_blank" href="{{ Memory::get('price.primer.file_name') ? asset('assets/price-list/'.Memory::get('price.primer.file_name')) : '#' }} ">Прайс-лист</a>
                                </li>
                                <li class="{{ Request::segment(1) == 'companies' && Request::segment(2) == 'primer' && Request::segment(3) == 'videos' ? 'active' : '' }}">
                                    <a href="{{ action('Marketing\VideosController@getIndex') }}">Відео</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="dropdown {{ Request::segment(1) == 'galleries' ? 'active' : '' }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Фотогалерея
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::segment(3) == 'sika' ? 'active' : '' }}">
                            <a href="{{ action('Marketing\GalleriesController@getShow', ['company' => 'sika']) }}">Sika</a>
                        </li>
                        <li class="{{ Request::segment(3) == 'sfs' ? 'active' : '' }}">
                            <a href="{{ action('Marketing\GalleriesController@getShow', ['company' => 'sfs']) }}">SFS intec</a>
                        </li>
                        <li class="{{ Request::segment(3) == 'primer' ? 'active' : '' }}">
                            <a href="{{ action('Marketing\GalleriesController@getShow', ['company' => 'primer']) }}">Праймер</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ Request::segment(1) == 'certificates' ? 'active' : '' }}">
                    <a href="{{ action('Marketing\CertificatesController@getIndex') }}">Сертифікати</a>
                </li>
                <li class="{{ Request::segment(1) == 'news' ? 'active' : '' }}">
                    <a href="{{ action('Marketing\NewsController@getIndex') }}">Новини</a>
                </li>
                <li class="{{ Request::segment(1) == 'contacts' ? 'active' : '' }}">
                    <a href="{{ action('Marketing\ContactsController@getIndex') }}">Контакти</a>
                </li>
                <!-- Конец Верхнего меню -->

                <!-- Search Block -->
                <li>
                    <i class="search fa fa-search search-btn"></i>
                    <div class="search-open">
                        <div class="input-group animated fadeInDown">
                            <input type="text" class="form-control" placeholder="Search">
                                <span class="input-group-btn">
                                    <button class="btn-u" type="button">Go</button>
                                </span>
                        </div>
                    </div>
                </li>
                <!-- End Search Block -->
            </ul>
        </div><!--/end container-->
    </div><!--/navbar-collapse-->
</div>