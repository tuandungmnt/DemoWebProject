<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiMiddleware;
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

//Auth
Route::get('/api/auth', 'AuthController@auth');

Route::middleware([ApiMiddleware::class])->group(function () {
    //Agent
    Route::get('/api/create_agent', 'AgentController@createAgent');

    Route::get('/api/find_agent', 'AgentController@findAgent');

    Route::get('/api/get_all_agent', 'AgentController@getAllAgent');

    //Job
    Route::get('/api/create_job', 'JobController@createJob');

    Route::get('/api/find_job', 'JobController@findJob');

    //Group
    Route::get('/api/create_group', 'GroupController@createGroup');

    Route::get('/api/find_group', 'GroupController@findGroup');

    //Permission
    Route::get('/api/create_permission', 'PermissionController@createPermission');

    Route::get('/api/find_permission', 'PermissionController@findPermission');

    //AgentJob
    Route::get('/api/create_agent_job', 'AgentJobController@createAgentJob');

    Route::get('/api/find_agent_job', 'AgentJobController@findAgentJob');

    //JobGroup
    Route::get('/api/create_job_group', 'JobGroupController@createJobGroup');

    Route::get('/api/find_job_group', 'JobGroupController@findJobGroup');

    //GroupPermission
    Route::get('/api/create_group_permission', 'GroupPermissionController@createGroupPermission');

    Route::get('/api/find_group_permission', 'GroupPermissionController@findGroupPermission');
});
