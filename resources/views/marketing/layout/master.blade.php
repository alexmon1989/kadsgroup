<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="ua"> <!--<![endif]-->
<head>
    <base href="{{ url() . '/' }}">
    <title>@yield('page_title', 'Головна') - Kads Group</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    @if (Request::segment(1) == null)
    <link rel="stylesheet" href="assets/css/footers/footer-v7.css">
    @else
    <link rel="stylesheet" href="assets/css/footers/footer-v1.css">
    @endif

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

    @section('top_content')
        @slider()
    @show

    @yield('full_width')

    @yield('companies')

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
<script type="text/javascript" src="assets/js/plugins/layer-slider.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
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