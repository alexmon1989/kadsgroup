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

elixir(function(mix) {
    mix.sass('custom.scss', assetsPublicPath + 'css/custom.css')

        // CSS шаблона
        .copy(assetsResourcesPath + 'plugins/bootstrap',
        assetsPublicPath + 'plugins/bootstrap')
        .copy(assetsResourcesPath + 'css/style.css',
        assetsPublicPath + 'css/style.css')
        .copy(assetsResourcesPath + 'css/ie8.css',
        assetsPublicPath + 'css/ie8.css')
        .copy(assetsResourcesPath + 'css/blocks.css',
        assetsPublicPath + 'css/blocks.css')
        .copy(assetsResourcesPath + 'css/plugins.css',
        assetsPublicPath + 'css/plugins.css')
        .copy(assetsResourcesPath + 'css/app.css',
        assetsPublicPath + 'css/app.css')
        .copy(assetsResourcesPath + 'css/plugins/style-switcher.css',
        assetsPublicPath + 'css/plugins/style-switcher.css')
        .copy(assetsResourcesPath + 'css/headers/header-default.css',
        assetsPublicPath + 'css/headers/header-default.css')
        .copy(assetsResourcesPath + 'css/footers/footer-v7.css',
        assetsPublicPath + 'css/footers/footer-v7.css')
        .copy(assetsResourcesPath + 'plugins/animate.css',
        assetsPublicPath + 'plugins/animate.css')
        .copy(assetsResourcesPath + 'plugins/line-icons',
        assetsPublicPath + 'plugins/line-icons')
        .copy(assetsResourcesPath + 'plugins/font-awesome',
        assetsPublicPath + 'plugins/font-awesome')
        .copy(assetsResourcesPath + 'plugins/layer-slider/layerslider',
        assetsPublicPath + 'plugins/layer-slider/layerslider')
        .copy(assetsResourcesPath + 'css/theme-colors/blue.css',
        assetsPublicPath + 'css/theme-colors/blue.css')

        // JS шаблона
        .copy(assetsResourcesPath + 'plugins/jquery',
        assetsPublicPath + 'plugins/jquery')
        .copy(assetsResourcesPath + 'plugins/back-to-top.js',
        assetsPublicPath + 'plugins/back-to-top.js')
        .copy(assetsResourcesPath + 'plugins/smoothScroll.js',
        assetsPublicPath + 'plugins/smoothScroll.js')
        .copy(assetsResourcesPath + 'plugins/sky-forms-pro/skyforms/js',
        assetsPublicPath + 'plugins/sky-forms-pro/skyforms/js')
        .copy(assetsResourcesPath + 'js/custom.js',
        assetsPublicPath + 'js/custom.js')
        .copy(assetsResourcesPath + 'js/app.js',
        assetsPublicPath + 'js/app.js')
        .copy(assetsResourcesPath + 'js/forms/contact.js',
        assetsPublicPath + 'js/forms/contact.js')
        .copy(assetsResourcesPath + 'js/plugins/layer-slider.js',
        assetsPublicPath + 'js/plugins/layer-slider.js')
        .copy(assetsResourcesPath + 'plugins/respond.js',
        assetsPublicPath + 'plugins/respond.js/')
        .copy(assetsResourcesPath + 'plugins/html5shiv.js',
        assetsPublicPath + 'plugins/html5shiv.js')
        .copy(assetsResourcesPath + 'plugins/placeholder-IE-fixes.js',
        assetsPublicPath + 'plugins/placeholder-IE-fixes.js')
    ;
});
