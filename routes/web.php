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
    /**
     * Projects CRUD
     */
    $router->group([
        'prefix' => 'projects',
        'namespace' => 'Project'
    ], function () use ($router) {
        $router->get('/', 'ProjectController@list');
        $router->post('/', 'ProjectController@create');
        $router->get('/{id}', 'ProjectController@index');
        $router->patch('/{id}', 'ProjectController@update');
        $router->delete('/{id}', 'ProjectController@delete');

        /**
         * Tasks CRUD
         */
        $router->group([
            'prefix' => '{projectId}/tasks',
            'namespace' => 'Task'
        ], function () use ($router) {
            $router->get('/', 'ProjectTaskController@list');
            $router->post('/', 'ProjectTaskController@create');
            $router->get('/{id}', 'ProjectTaskController@index');
            $router->patch('/{id}', 'ProjectTaskController@update');
            $router->delete('/{id}', 'ProjectTaskController@delete');
        });
    });
});
