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

Route::get('/', function () { return 'welcome'; });

Route::get('/api/create', 'UserController@createUser');

Route::get('/api/delete', 'UserController@deleteUser');

Route::get('/api/update', 'UserController@updateUser');

Route::get('/api/read','UserController@readUser');
