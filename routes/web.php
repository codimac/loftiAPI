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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'auth'], function($router) {
    $router->post('/signin', 'AuthController@signIn');
});

$router->group([
    'middleware' => 'auth:api',
    'prefix' => 'users',
], function($router) {
    $router->get('/me', 'UserController@getAuthUser');
	$router->post('/create', 'UserController@createUser');
	$router->put('/update/{id}', 'UserController@updateUser');
});

$router->group([
    'middleware' => 'auth:api',
    'prefix' => 'students',
], function($router) {
    $router->get('', 'StudentController@getAllStudents');
    // A DEPLACER DANS LE CONTROLLER PROMO
    // $router->get('/promo/{year}', 'PromoController@getStudentsByPromo');
    $router->get('/promo/{year}', 'StudentController@getStudentsByPromo');
});

$router->group([
    'middleware' => 'auth:api',
    'prefix' => 'ues',
], function($router) {
    $router->get('', 'UeController@getAllUe');
    $router->get('/semesters/{semester}', 'UeController@getUeBySemester');
});