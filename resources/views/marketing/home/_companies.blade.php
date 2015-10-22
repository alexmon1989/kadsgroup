<div class="container-fluid">
    <div class="row height-300 companies">
        <div class="container content-md">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="thumbnails thumbnail-style">
                        <div class="row">
                            <div class="col-md-12 margin-bottom-10 height-100">
                                <a href="{{ action('Marketing\Companies\AboutController@getShow', ['shortTitle' => 'sika']) }}">
                                    <img class="img-responsive" alt="" src="assets/img/companies/top/1.png">
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ action('Marketing\Companies\AboutController@getShow', ['shortTitle' => 'sika']) }}"><img alt="" src="assets/img/companies/1.jpg" class="img-responsive"></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 company-menu text-center">
                                <div class="links">
                                    <a href="#">Каталог</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="thumbnails thumbnail-style">
                        <div class="row">
                            <div class="col-md-12 margin-bottom-10 height-100">
                                <a href="{{ action('Marketing\Companies\AboutController@getShow', ['shortTitle' => 'sfs']) }}">
                                    <img class="img-responsive" alt="" src="assets/img/companies/top/2.png">
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ action('Marketing\Companies\AboutController@getShow', ['shortTitle' => 'sfs']) }}">
                                    <img alt="" src="assets/img/companies/2.jpg" class="img-responsive">
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 company-menu text-center">
                                <div class="links">
                                    <a href="#">Каталог</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="thumbnails thumbnail-style">
                        <div class="row">
                            <div class="col-md-12 margin-bottom-10 height-100">
                                <a href="{{ action('Marketing\Companies\AboutController@getShow', ['shortTitle' => 'primer']) }}">
                                    <img class="img-responsive" alt="" src="assets/img/companies/top/3.png">
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ action('Marketing\Companies\AboutController@getShow', ['shortTitle' => 'primer']) }}">
                                    <img alt="" src="assets/img/companies/3.jpg" class="img-responsive">
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 company-menu text-center">
                                <div class="links">
                                    <a class="active" href="#">Прайс</a> |
                                    <a href="{{ action('Marketing\VideosController@getIndex') }}">Відео</a> |
                                    <a href="#">Каталог</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>