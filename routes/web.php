<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

/**
 * Profile routes
 */
Route::group(['middleware' => 'auth', 'namespace' => 'Profile', 'as' => 'profile.'], function() {
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/profile', 'HomeController@profile')->name('profile');
    Route::put('/user/{id}/change-profile', 'UserController@changeProfile')->name('change-profile')->where(['id' => '[0-9]+']);
    Route::put('/user/{id}/change-picture', 'UserController@changePicture')->name('change-picture')->where(['id' => '[0-9]+']);
    Route::put('/user/{id}/remove-picture', 'UserController@removePicture')->name('remove-picture')->where(['id' => '[0-9]+']);
    Route::put('/user/{id}/change-password', 'UserController@changePassword')->name('change-password')->where(['id' => '[0-9]+']);

});

/**
 * Permission's routes to modify users
 */
Route::group(['middleware' => 'auth', 'namespace' => 'Permission', 'as' => 'users.'], function() {
    Route::put('/user/{id}/block', 'UserController@blockUser')->name('block')->where(['id' => '[0-9]+']);
    Route::put('/user/{id}/unblock', 'UserController@unblockUser')->name('unblock')->where(['id' => '[0-9]+']);
});

/**
 * Client routes
 */
Route::group(['middleware' => 'auth', 'namespace' => 'Client'], function() {
    Route::resource('clientes', 'ClientController');
});

/**
 * Service routes
 */
Route::group(['middleware' => 'auth', 'namespace' => 'Service'], function() {
    Route::resource('servicos', 'ServiceController');
});

/**
 * Schedule routes
 */
Route::group(['middleware' => 'auth', 'namespace' => 'Schedule', 'as' => 'agendas.'], function() {
    Route::get('agendas/search/{date}', 'ScheduleController@search')->name('search');
    Route::get('agendas/busca', 'ScheduleController@busca')->name('busca');
    Route::post('agendas/buscar', 'ScheduleController@buscar')->name('buscar');
    Route::get('totalRecebidoMes', 'ScheduleController@totalRecebidoMes')->name('totalRecebidoMes');
    Route::get('agendamentosServico', 'ScheduleController@agendamentosServico')->name('agendamentosServico');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Schedule'], function() {
    Route::resource('agendas', 'ScheduleController');
});