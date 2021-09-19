<?php

use App\Http\Controllers\UserController;

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('Userlist','UserController@index');
    $router->get('Userlist/{id}','UserController@listOne');
    $router->post('addTask','UserController@store');
    $router->put('editTask/{$id}','UserController@update');
    $router->delete('deleteTask/{$id}','UserController@destroy');
    $router->get('Tasklist/{id}','UserController@listTasks');
});

