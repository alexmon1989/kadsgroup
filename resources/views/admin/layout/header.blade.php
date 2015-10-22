<header class="main-header">
    <a href="{{ action('Admin\DashboardController@getIndex') }}" class="logo"><b>KadsGroup</b>.com.ua</a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="{{ asset('assets/plugins/adminlte/dist/img/avatar.png') }}" class="user-image" alt="User Image"/>
                      <span class="hidden-xs">{{ $auser->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset('assets/plugins/adminlte/dist/img/avatar.png') }}" class="img-circle" alt="User Image" />
                            <p>
                                {{ $auser->name }} - Администратор сайта
                                <small>Зарегистрирован {{ date('d.m.Y', strtotime($auser->created_at)) }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ action('Auth\AuthController@getEdit', ['id' => $auser->id]) }}" class="btn btn-default btn-flat">Профиль</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ action('Auth\AuthController@getLogout') }}" class="btn btn-default btn-flat">Выход</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>