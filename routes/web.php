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
	'prefix' => 'abs',
	'middleware' => 'auth:api'
], function($router) {
    $router->post('/create', 'AbsenceController@create');
});



$router->group([
    'middleware' => 'auth:api',
    'prefix' => 'users',
], function($router) {
    $router->get('/me', 'UserController@getAuthUser');
    //$router->post('/create', 'UserController@createUser');
    //$router->put('/update/{id}', 'UserController@updateUser');
});

$router->group([
    'middleware' => 'auth:api',
    'prefix' => 'promos',
], function($router) {
    $router->get('/', 'PromoController@getAllStudents');
    $router->get('/{year}', 'PromoController@getStudentsByPromo');
    $router->get('/{year}/semesters', 'PromoController@getSemestersByPromo');
});

$router->group([
    'middleware' => 'auth:api',
    'prefix' => 'ues',
], function($router) {
    $router->get('/semesters/', 'UeController@getAllUes');
    $router->get('/semesters/{semesterId}', 'UeController@getUesBySemester');
});


$router->group([
    'middleware' => 'auth:api',
    'prefix' => 'subjects',
], function($router) {
    $router->get('/ues/{ueId}', 'SubjectController@getSubjectsByUe');
    $router->get('/semesters/{semestrerId}', 'SubjectController@getSubjectsBySemester');
    $router->get('/promos/{year}', 'SubjectController@getSubjectsByPromo');
});



