<?php
use Illuminate\Support\Facades\Route;
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
Auth::routes([
    'register' => env('AUTH_ALLOW_REGISTER'),
    'reset' => env('AUTH_ALLOW_PW_RESET'),
    'verify' => env('AUTH_ALLOW_MAIL_VERIFY')
    ]);

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('/panel')->group(function () {
    Route::get('/', 'DashboardController@showMainPage')->name('dashboard');
    Route::post('/sms', 'SmsController@sendSms')->name('sms.send');
    Route::get('/sms/history', 'SmsController@showSmsHistory')->name('sms.history');

    Route::get('/clients', 'ClientController@showMainPage')->name('clients');
    Route::post('/clients', 'ClientController@search')->name('clients.search');
    Route::post('/clients/add', 'ClientController@store')->name('clients.add');
    Route::get('/clients/add', 'ClientController@showAddForm')->name('clients.add_form');
    Route::get('/clients/edit/{id}', 'ClientController@showEditForm')->name('clients.edit_form');
    Route::post('/clients/edit', 'ClientController@update')->name('clients.update');
    Route::post('/clients/delete', 'ClientController@remove')->name('clients.remove');

    Route::get('/infos', 'InfoController@showMainPage')->name('infos');
    Route::get('/infos/add', 'InfoController@showAddForm')->name('infos.add_form');
    Route::post('/infos/add', 'InfoController@store')->name('infos.add');
    Route::get('/infos/edit/{id}', 'InfoController@showEditForm')->name('infos.edit_form');
    Route::post('/infos/edit', 'InfoController@update')->name('infos.update');
    Route::post('/infos/delete', 'InfoController@remove')->name('infos.remove');
});

Route::get('/getreport', 'ReportController@getReportsFromApi');
