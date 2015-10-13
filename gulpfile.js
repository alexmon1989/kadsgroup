var gulp = require('gulp');
var shell = require('gulp-shell');
var elixir = require('laravel-elixir');
var del = require('del');

elixir.extend("remove", function(path) {
    gulp.task("remove", function() {
        del(path);
    });
    return gulp.start("remove");
});
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

var assetsPublicPath = 'public/assets/';
var assetsResourcesPath = 'resources/assets/';
var assetsResourcesPathBootstrapUnify = assetsResourcesPath + 'bootstrap_unify/';
var assetsResourcesPathAdminLte = assetsResourcesPath + 'bower_components/adminlte/';

elixir(function(mix) {
    mix.sass('custom.scss', assetsPublicPath + 'css/custom.css')

        // CSS шаблона
        .copy(assetsResourcesPathBootstrapUnify + 'plugins/bootstrap',
        assetsPublicPath + 'plugins/bootstrap')
        .copy(assetsResourcesPathBootstrapUnify + 'css/style.css',
        assetsPublicPath + 'css/style.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/ie8.css',
        assetsPublicPath + 'css/ie8.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/blocks.css',
        assetsPublicPath + 'css/blocks.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/plugins.css',
        assetsPublicPath + 'css/plugins.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/app.css',
        assetsPublicPath + 'css/app.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/plugins/style-switcher.css',
        assetsPublicPath + 'css/plugins/style-switcher.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/headers/header-default.css',
        assetsPublicPath + 'css/headers/header-default.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/footers/footer-v1.css',
        assetsPublicPath + 'css/footers/footer-v1.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/footers/footer-v7.css',
        assetsPublicPath + 'css/footers/footer-v7.css')
        .copy(assetsResourcesPathBootstrapUnify + 'plugins/animate.css',
        assetsPublicPath + 'plugins/animate.css')
        .copy(assetsResourcesPathBootstrapUnify + 'plugins/line-icons',
        assetsPublicPath + 'plugins/line-icons')
        .copy(assetsResourcesPathBootstrapUnify + 'plugins/font-awesome',
        assetsPublicPath + 'plugins/font-awesome')
        .copy(assetsResourcesPathBootstrapUnify + 'plugins/layer-slider/layerslider',
        assetsPublicPath + 'plugins/layer-slider/layerslider')
        .copy(assetsResourcesPathBootstrapUnify + 'css/theme-colors/blue.css',
        assetsPublicPath + 'css/theme-colors/blue.css')

        // JS шаблона
        .copy(assetsResourcesPathBootstrapUnify + 'plugins/jquery',
        assetsPublicPath + 'plugins/jquery')
        .copy(assetsResourcesPathBootstrapUnify + 'plugins/back-to-top.js',
        assetsPublicPath + 'plugins/back-to-top.js')
        .copy(assetsResourcesPathBootstrapUnify + 'plugins/smoothScroll.js',
        assetsPublicPath + 'plugins/smoothScroll.js')
        .copy(assetsResourcesPathBootstrapUnify + 'plugins/sky-forms-pro/skyforms/js',
        assetsPublicPath + 'plugins/sky-forms-pro/skyforms/js')
        .copy(assetsResourcesPathBootstrapUnify + 'js/custom.js',
        assetsPublicPath + 'js/custom.js')
        .copy(assetsResourcesPathBootstrapUnify + 'js/app.js',
        assetsPublicPath + 'js/app.js')
        .copy(assetsResourcesPathBootstrapUnify + 'js/forms/contact.js',
        assetsPublicPath + 'js/forms/contact.js')
        .copy(assetsResourcesPathBootstrapUnify + 'js/plugins/layer-slider.js',
        assetsPublicPath + 'js/plugins/layer-slider.js')
        .copy(assetsResourcesPathBootstrapUnify + 'plugins/respond.js',
        assetsPublicPath + 'plugins/respond.js/')
        .copy(assetsResourcesPathBootstrapUnify + 'plugins/html5shiv.js',
        assetsPublicPath + 'plugins/html5shiv.js')
        .copy(assetsResourcesPathBootstrapUnify + 'plugins/placeholder-IE-fixes.js',
        assetsPublicPath + 'plugins/placeholder-IE-fixes.js')


        // AdminLTE
        .copy(assetsResourcesPathAdminLte + 'bootstrap',
        assetsPublicPath + 'plugins/adminlte/bootstrap')
        .copy(assetsResourcesPathAdminLte + 'dist',
        assetsPublicPath + 'plugins/adminlte/dist')
        .copy(assetsResourcesPathAdminLte + 'plugins',
        assetsPublicPath + 'plugins/adminlte/plugins')
        .copy(assetsResourcesPath + 'js/admin-lte/custom.js',
        assetsPublicPath + 'plugins/adminlte/dist/js/custom.js')
    ;
});
