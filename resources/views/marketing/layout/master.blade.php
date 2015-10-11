<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="ru"> <!--<![endif]-->
<head>
    <base href="{{ url() . '/' }}">
    <title>@yield('page_title', 'Главная') - Kads Group</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('meta')

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.gif">

    <!-- Web Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="assets/css/headers/header-default.css">
    <link rel="stylesheet" href="assets/css/footers/footer-v7.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="assets/plugins/animate.css">
    <link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/plugins/layer-slider/layerslider/css/layerslider.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="assets/css/theme-colors/blue.css" id="style_color">

    @yield('styles')

    <!-- CSS Customization -->
    <link rel="stylesheet" href="assets/css/custom.css">
</head>


<body>
<div class="wrapper">
    <!--=== Header ===-->
    @include('marketing.layout.header')
    <!--=== End Header ===-->

    <!--=== Slider ===-->
    @slider()
    <!--=== End Slider ===-->

    <div class="container-fluid">
        <div class="row height-300 companies">
            <div class="container content-md">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="thumbnails thumbnail-style">
                            <div class="row">
                                <div class="col-md-12 margin-bottom-10 height-100">
                                    <img class="img-responsive" alt="" src="assets/img/companies/top/1.png">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <img alt="" src="assets/img/companies/1.jpg" class="img-responsive">
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
                                    <img class=" img-responsive" alt="" src="assets/img/companies/top/2.png">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <img alt="" src="assets/img/companies/2.jpg" class="img-responsive">
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
                                    <img class="img-responsive" alt="" src="assets/img/companies/top/3.png">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <img alt="" src="assets/img/companies/3.jpg" class="img-responsive">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 company-menu text-center">
                                    <div class="links">
                                        <a class="active" href="#">Прайс</a> |
                                        <a href="#">Відео</a> |
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

    <!--=== Content ===-->
    <div class="container content-md height-500">
        @yield('content', 'Информация отсутствует')
    </div>
    <!--=== End Content ===-->

    @include('marketing.layout.informers')

    @section('footer')
        @include('marketing.layout.footer')
    @show

</div><!--/wrapper-->

<!-- JS Global Compulsory -->
<script type="text/javascript" src="assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="assets/plugins/smoothScroll.js"></script>
<script type="text/javascript" src="assets/plugins/layer-slider/layerslider/js/greensock.js"></script>
<script type="text/javascript" src="assets/plugins/layer-slider/layerslider/js/layerslider.transitions.js"></script>
<script type="text/javascript" src="assets/plugins/layer-slider/layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
<script type="text/javascript" src="assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js"></script>
<script type="text/javascript" src="assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="assets/js/custom.js"></script>
<!-- JS Page Level -->
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/forms/contact.js"></script>
<script type="text/javascript" src="assets/js/plugins/layer-slider.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        ContactForm.initContactForm();
        LayerSlider.initLayerSlider();
    });
</script>
<!--[if lt IE 9]>
<script src="assets/plugins/respond.js"></script>
<script src="assets/plugins/html5shiv.js"></script>
<script src="assets/plugins/placeholder-IE-fixes.js"></script>
<script src="assets/plugins/sky-forms-pro/skyforms/js/sky-forms-ie8.js"></script>
<![endif]-->

<!--[if lt IE 10]>
<script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js"></script>
<![endif]-->

@yield('scripts')

</body>
</html>