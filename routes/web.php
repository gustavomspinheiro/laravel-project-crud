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

//web routes
Route::get('/', 'WebController@home')->name('home');
Route::post('/filtrar', 'WebController@filter')->name('home.filter');

//user routes
Route::get('/usuario/novo', 'UserController@registerForm')->name('user.register');
Route::post('/usuario/store', 'UserController@storeUser')->name('user.register.do');

//admin routes
Route::get('/admin', 'AdminController@main')->name('admin.main');
Route::get('/admin/login', 'AdminController@loginForm')->name('admin.login');
Route::post('/admin/login/do', 'AdminController@loginUser')->name('admin.login.do');
Route::get('/admin/logout', 'AdminController@logoutUser')->name('admin.logout');

Route::post('/admin/suggestion', 'AdminController@createSuggestion')->name('admin.suggestion');

