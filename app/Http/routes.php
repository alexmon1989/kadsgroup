<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'Marketing\HomeController@index');
// Группа роутов польз. части
Route::group(['namespace' => 'Marketing'], function()
{
    Route::controllers([
        'certificates'                  => 'CertificatesController',
        'companies/sika/catalog'        => 'Companies\Sika\CatalogController',
        'companies/sfs/catalog'         => 'Companies\Sfs\CatalogController',
        'companies/primer/catalog'      => 'Companies\Primer\CatalogController',
        'contacts'                      => 'ContactsController',
        'galleries'                     => 'GalleriesController',
        'news'                          => 'NewsController',
        'search'                        => 'SearchController',
    ]);

    Route::get('companies/{company}/about', 'Companies\AboutController@getShow');

    Route::get('companies/primer/videos', 'VideosController@getIndex');

    // Sitemap
    Route::get('sitemap/{format?}/{cached?}', 'SitemapController@getIndex');
});

// Authentication routes...
Route::get('admin', ['middleware' => 'auth', 'uses' => 'Admin\DashboardController@getIndex']);

// Роут контроллера авторизации, middleware указан в его конструкторе
Route::controller('admin/auth', 'Auth\AuthController');

// Группа роутов админки
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function()
{
    Route::controllers([
        'certificates'                          => 'CertificatesController',
        'companies/catalog/categories'          => 'Companies\Catalog\CategoriesController',
        'companies/catalog/groups-categories'   => 'Companies\Catalog\GroupsCategoriesController',
        'companies/descriptions'                => 'Companies\DescriptionsController',
        'companies/prices'                      => 'Companies\PriceListsController',
        'companies/primer/videos'               => 'VideosController',
        'contacts'                              => 'ContactsController',
        'dashboard'                             => 'DashboardController',
        'galleries'                             => 'GalleriesController',
        'home'                                  => 'HomeController',
        'news'                                  => 'NewsController',
        'settings'                              => 'SettingsController',
        'sliders'                               => 'SliderController',
    ]);

    Route::controller('companies/catalog/products/sika', 'Companies\Catalog\Products\SikaController', [
        'anyData'  => 'datatables.sika.data',
    ]);

    Route::controller('companies/catalog/products/primer', 'Companies\Catalog\Products\PrimerController', [
        'anyData'  => 'datatables.primer.data',
    ]);

    Route::controller('companies/catalog/products/sfs', 'Companies\Catalog\Products\SfsController', [
        'anyData'  => 'datatables.sfs.data',
    ]);
});