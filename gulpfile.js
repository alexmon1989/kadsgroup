var gulp = require('gulp');
var shell = require('gulp-shell');
var elixir = require('laravel-elixir');
var del = require('del');

elixir.config.sourcemaps = false;

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
        .copy(assetsResourcesPathBootstrapUnify + 'css/headers/header-default.css',
        assetsPublicPath + 'css/headers/header-default.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/footers/footer-v1.css',
        assetsPublicPath + 'css/footers/footer-v1.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/footers/footer-v7.css',
        assetsPublicPath + 'css/footers/footer-v7.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/theme-colors/blue.css',
        assetsPublicPath + 'css/theme-colors/blue.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/theme-colors/default.css',
        assetsPublicPath + 'css/theme-colors/default.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/theme-skins/dark.css',
        assetsPublicPath + 'css/theme-skins/dark.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/pages/page_error4_404.css',
        assetsPublicPath + 'css/pages/page_error4_404.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/pages/page_search_inner.css',
        assetsPublicPath + 'css/pages/page_search_inner.css')
        .copy(assetsResourcesPathBootstrapUnify + 'css/pages/page_clients.css',
        assetsPublicPath + 'css/pages/page_clients.css')

        // JS шаблона
        .copy(assetsResourcesPathBootstrapUnify + 'js/custom.js',
        assetsPublicPath + 'js/custom.js')
        .copy(assetsResourcesPathBootstrapUnify + 'js/app.js',
        assetsPublicPath + 'js/app.js')
        .copy(assetsResourcesPathBootstrapUnify + 'js/forms/contact.js',
        assetsPublicPath + 'js/forms/contact.js')
        .copy(assetsResourcesPathBootstrapUnify + 'js/pages/page_contacts.js',
        assetsPublicPath + 'js/pages/page_contacts.js')
        .copy(assetsResourcesPathBootstrapUnify + 'js/forms/order.js',
        assetsPublicPath + 'js/forms/order.js')

        // Plugins Шаблона
        .copy(assetsResourcesPathBootstrapUnify + 'js/plugins',
        assetsPublicPath + 'js/plugins')
        .copy(assetsResourcesPathBootstrapUnify + 'plugins',
        assetsPublicPath + 'plugins')

        // Images шаблона
        .copy(assetsResourcesPathBootstrapUnify + 'img/blur/img2.jpg',
        assetsPublicPath + 'img/blur/img2.jpg')

        // AdminLTE
        .copy(assetsResourcesPathAdminLte + 'bootstrap',
        assetsPublicPath + 'plugins/adminlte/bootstrap')
        .copy(assetsResourcesPathAdminLte + 'dist',
        assetsPublicPath + 'plugins/adminlte/dist')
        .copy(assetsResourcesPathAdminLte + 'plugins',
        assetsPublicPath + 'plugins/adminlte/plugins')
        .copy(assetsResourcesPath + 'js/admin-lte/custom.js',
        assetsPublicPath + 'plugins/adminlte/dist/js/custom.js')
        .sass('custom-adminlte.scss', assetsPublicPath + 'plugins/adminlte/dist/css/custom.css')
    ;
});
