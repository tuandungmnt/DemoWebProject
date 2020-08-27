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
//Agent
Route::get('/api/create_agent', 'AgentController@createAgent');

Route::get('/api/find_agent', 'AgentController@findAgent');

//Job
Route::get('/api/create_job', 'JobController@createJob');

Route::get('/api/find_job', 'JobController@findJob');

//AgentJob
Route::get('/api/create_agent_job', 'AgentJobController@createAgentJob');

Route::get('/api/find_agent_job', 'AgentJobController@findAgentJob');

