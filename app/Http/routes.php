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
        'companies/catalog/sika'        => 'Companies\Sika\CatalogController',
        'companies/catalog/primer'      => 'Companies\Primer\CatalogController',
        'contacts'                      => 'ContactsController',
        'galleries'                     => 'GalleriesController',
        'news'                          => 'NewsController',
    ]);

    Route::get('companies/{company}/about', 'Companies\AboutController@getShow');

    Route::get('companies/primer/videos', 'VideosController@getIndex');
});

// Authentication routes...
Route::get('admin', ['middleware' => 'auth', 'uses' => 'Admin\DashboardController@getIndex']);
/*
Route::get('admin/auth/login', 'Auth\AuthController@getLogin');
Route::post('admin/auth/login', 'Auth\AuthController@postLogin');
Route::get('admin/auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
*/
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
});