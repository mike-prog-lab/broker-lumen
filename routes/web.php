<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

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

$router->group([
    'middleware' => 'auth',
], function () use ($router) {
    $router->group([
        'prefix' => 'projects',
    ], function () use ($router) {
        $router->get('/', 'Project\ProjectController@list');
        $router->post('/', 'Project\ProjectController@create');
        $router->get('/{id}', 'Project\ProjectController@index');
        $router->patch('/{id}', 'Project\ProjectController@update');
        $router->delete('/{id}', 'Project\ProjectController@delete');
    });
});
