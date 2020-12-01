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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'TasksController@index');
Route::post('/task', 'TasksController@create');
Route::delete('/task/{task}', 'TasksController@delete');
Route::get('/task/{task}', 'TasksController@show');
Route::post('/task/{task}', 'TasksController@update');

Route::post('/task/{task}/addgroup', 'TasksController@add_group');
Route::delete('/task/{task}/delgroup/{group}', 'TasksController@del_group');


Route::get('/statuses', 'StatusController@index');
Route::post('/statuses', 'StatusController@create');
Route::delete('/statuses/{status}', 'StatusController@delete');
Route::get('/statuses/{status}', 'StatusController@show');
Route::post('/statuses/{status}', 'StatusController@update');
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/groups', 'GroupsController@index');
Route::post('/groups', 'GroupsController@create');
Route::delete('/groups/{group}', 'GroupsController@delete');
Route::get('/groups/{group}', 'GroupsController@show');
Route::post('/groups/{group}', 'GroupsController@update');


/* AJAX Routes */

Route::get('/ajax', 'AjaxController@index');
Route::get('/ajax/tasks', 'AjaxController@task_list');
Route::post('/ajax', 'AjaxController@create');
Route::delete('/ajax/{task}', 'AjaxController@delete');

