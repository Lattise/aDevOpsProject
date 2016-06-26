<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', 'HomeController@index');
$app->post('/hook', 'HomeController@index');
$app->get('/p/{project}', ['as' => 'project', 'uses' => 'ProjectController@index']);

$app->get('/log/{id}', ['uses' => 'LogController@log']);

$app->get('/p/{project}/deploy', ['as' => 'deploy', 'uses' => 'DeployController@index']);
$app->post('/p/{project}/deploy', ['uses' => 'DeployController@execute']);

$app->get('/p/{project}/fire', ['as' => 'fire', 'uses' => 'FireController@index']);
$app->post('/p/{project}/fire', ['uses' => 'FireController@execute']);

$app->get('/p/{project}/sql', ['as' => 'sql', 'uses' => 'SqlController@index']);
$app->post('/p/{project}/sql', ['as' => 'sql', 'uses' => 'SqlController@execute']);

$app->get('/p/{project}/job', ['as' => 'job', 'uses' => 'JobController@index']);
$app->post('/p/{project}/job', ['uses' => 'JobController@execute']);

$app->get('/p/{project}/env', ['as' => 'env', 'uses' => 'EnvController@index']);
$app->post('/p/{project}/env/patch', ['uses' => 'EnvController@patch']);
$app->post('/p/{project}/env', ['uses' => 'EnvController@add']);
$app->delete('/p/{project}/env/{id}', ['uses' => 'EnvController@del']);

$app->get('/p/{project}/env/dump.{format}', ['as' => 'env.dump', 'uses' => 'EnvController@dump']);
