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
                <li class="{{ Request::segment(1) == 'home' || Request::segment(1) == '' ? 'active' : '' }}">
                    <a href="{{ action('Marketing\HomeController@index') }}">Головна</a>
                </li>


                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        Фотогалерея
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Фотогалерея 1</a></li>
                        <li><a href="#">Фотогалерея 2</a></li>
                        <li><a href="#">Фотогалерея 3</a></li>
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