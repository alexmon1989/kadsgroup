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
        'certificates'                      => 'CertificatesController',
        'companies/sika/catalog'            => 'Companies\Sika\CatalogController',
        'companies/sfs/catalog'             => 'Companies\Sfs\CatalogController',
        'companies/primer/catalog'          => 'Companies\Primer\CatalogController',
        'companies/primer/price-list'       => 'Companies\PriceListController',
        'contacts'                          => 'ContactsController',
        'galleries'                         => 'GalleriesController',
        'news'                              => 'NewsController',
        'search'                            => 'SearchController',
    ]);

    Route::get('companies/sika/catalog/index/{categoryId?}', 'Companies\Sika\CatalogController@getIndex');
    Route::get('companies/primer/catalog/index/{categoryId?}', 'Companies\Primer\CatalogController@getIndex');
    Route::get('companies/sfs/catalog/index/{categoryId?}', 'Companies\Sfs\CatalogController@getIndex');

    Route::get('companies/{company}/about', 'Companies\AboutController@getShow');

    Route::get('companies/{company}/videos', 'VideosController@getIndex');

    Route::get('partners-and-projects',  [
        'as' => 'partners-and-projects', 'uses' => 'PartnersProjectsController@index'
    ]);
    Route::get('partners-and-projects/{slug}',  [
        'as' => 'project-action', 'uses' => 'PartnersProjectsController@project'
    ]);

    // Sitemap
    Route::get('sitemap/{format?}/{cached?}', 'SitemapController@getIndex');

    Route::post('order', [
        'uses' => 'Companies\OrdersController@makeOrder',
        'as' => 'order',
    ]);
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
        'companies/catalog/settings'            => 'Companies\Catalog\SettingsController',
        'companies/descriptions'                => 'Companies\DescriptionsController',
        'companies/prices'                      => 'Companies\PriceListsController',
        'companies/{company}/videos'            => 'VideosController',
        'contacts'                              => 'ContactsController',
        'dashboard'                             => 'DashboardController',
        'galleries'                             => 'GalleriesController',
        'home'                                  => 'HomeController',
        'news'                                  => 'NewsController',
        'partners-and-projects/partners'        => 'PartnersController',
        'partners-and-projects/projects'        => 'ProjectsController',
        'settings'                              => 'SettingsController',
        'sliders'                               => 'SliderController',
    ]);

    Route::get('orders', [
        'uses' => 'OrdersController@getIndex',
        'as' => 'orders.index'
    ]);
    Route::get('orders/edit/{order}', [
        'uses' => 'OrdersController@getEdit',
        'as' => 'orders.edit'
    ]);
    Route::post('orders/edit/{order}', [
        'uses' => 'OrdersController@postEdit'
    ]);
    Route::get('orders/delete/{order}', [
        'uses' => 'OrdersController@getDelete',
        'as' => 'orders.delete'
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