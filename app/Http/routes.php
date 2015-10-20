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
        'certificates'  => 'CertificatesController',
        'contacts'      => 'ContactsController',
        'galleries'     => 'GalleriesController',
        'news'          => 'NewsController',
        'videos'        => 'VideosController',
    ]);
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
        'certificates'              => 'CertificatesController',
        'contacts'                  => 'ContactsController',
        'dashboard'                 => 'DashboardController',
        'galleries'                 => 'GalleriesController',
        'news'                      => 'NewsController',
        'settings'                  => 'SettingsController',
        'videos'                    => 'VideosController',
    ]);
});