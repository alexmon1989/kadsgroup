<div class="header no-topbar">
    <div class="container">
        <!-- Logo -->
        <a class="logo" href="{{ url() }}">
            <img src="{{ asset('assets/img/logo-kadsgroup.png') }}" alt="Группа компаний Kadsgroup">
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
                        Группа компаний
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu {{ Request::segment(1) == 'companies' && Request::segment(2) == 'sika' ? 'active' : '' }}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sika</a>
                            <ul class="dropdown-menu">
                                <li class="{{ Request::segment(1) == 'companies'&& Request::segment(2) == 'sika' && Request::segment(3) == 'about'  ? 'active' : '' }}">
                                    <a href="{{ action('Marketing\Companies\AboutController@getShow', ['shortTitle' => 'sika']) }}">О компании</a>
                                </li>
                                <li class="{{ Request::segment(1) == 'companies'&& Request::segment(2) == 'sika' && Request::segment(3) == 'catalog'  ? 'active' : '' }}">
                                    <a href="{{ action('Marketing\Companies\Sika\CatalogController@getIndex') }}">Каталог</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu {{ Request::segment(1) == 'companies' && Request::segment(2) == 'sfs' ? 'active' : '' }}">
                            <a href="#">Sfs intec</a>
                            <ul class="dropdown-menu">
                                <li class="{{ Request::segment(1) == 'companies' && Request::segment(2) == 'sfs' && Request::segment(3) == 'about' ? 'active' : '' }}">
                                    <a href="{{ action('Marketing\Companies\AboutController@getShow', ['shortTitle' => 'sfs']) }}">О компании</a>
                                </li>
                                <li class="{{ Request::segment(1) == 'companies'&& Request::segment(2) == 'sfs' && Request::segment(3) == 'catalog'  ? 'active' : '' }}">
                                    <a href="{{ action('Marketing\Companies\Sfs\CatalogController@getIndex') }}">Каталог</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu {{ Request::segment(1) == 'companies' && Request::segment(2) == 'primer' ? 'active' : '' }}">
                            <a href="#">Праймер</a>
                            <ul class="dropdown-menu">
                                <li class="{{ Request::segment(1) == 'companies' && Request::segment(2) == 'primer' && Request::segment(3) == 'about' ? 'active' : '' }}">
                                    <a href="{{ action('Marketing\Companies\AboutController@getShow', ['shortTitle' => 'primer']) }}">О компании</a>
                                </li>
                                <li class="{{ Request::segment(1) == 'companies'&& Request::segment(2) == 'primer' && Request::segment(3) == 'catalog'  ? 'active' : '' }}">
                                    <a href="{{ action('Marketing\Companies\Primer\CatalogController@getIndex') }}">Каталог</a>
                                </li>
                                <li>
                                    @if(Memory::get('price.primer.file_name'))
                                    <a target="_blank" href="{{ asset('assets/price-list/'.Memory::get('price.primer.file_name')) }}">Прайс-лист</a>
                                    @else
                                    <a href="{{ Request::url().'#' }} ">Прайс-лист</a>
                                    @endif
                                </li>
                                <li class="{{ Request::segment(1) == 'companies' && Request::segment(2) == 'primer' && Request::segment(3) == 'videos' ? 'active' : '' }}">
                                    <a href="{{ action('Marketing\VideosController@getIndex') }}">Видео</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="dropdown {{ Request::segment(1) == 'galleries' ? 'active' : '' }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Фотогалереи
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
                    <a href="{{ action('Marketing\CertificatesController@getIndex') }}">Сертификаты</a>
                </li>
                <li class="{{ Request::segment(1) == 'news' ? 'active' : '' }}">
                    <a href="{{ action('Marketing\NewsController@getIndex') }}">Новости</a>
                </li>
                <li class="{{ Request::segment(1) == 'contacts' ? 'active' : '' }}">
                    <a href="{{ action('Marketing\ContactsController@getIndex') }}">Контакты</a>
                </li>
                <!-- Конец Верхнего меню -->

                <!-- Search Block -->
                <li>
                    <i class="search fa fa-search search-btn"></i>

                     <form action="{{ action('Marketing\SearchController@getIndex') }}" method="get">
                        <div class="search-open">
                            <div class="input-group animated fadeInDown">
                                    <input type="text" name="q" class="form-control" placeholder="Поиск">
                                    <span class="input-group-btn">
                                        <button class="btn-u" type="submit">Искать</button>
                                    </span>
                            </div>
                        </div>
                     </form>
                </li>
                <!-- End Search Block -->
            </ul>
        </div><!--/end container-->
    </div><!--/navbar-collapse-->
</div>