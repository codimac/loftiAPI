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


$router->group(['prefix' => 'subject'], function($router) {
    $router->post('/ue_id', 'SubjectController@getSubjectByUE');
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
    $router->post('/promo/all', 'StudentController@getAllStudents');
    $router->get('/promo/{year}', 'StudentController@getStudentsByPromo');
});

$router->group([
    'middleware' => 'auth:api',
    'prefix' => 'ue',
], function($router) {
    $router->post('/semesters/all', 'UeController@getAllUe');
    $router->get('/semesters/{semester_id}', 'Ue@getUeBySemester');
});

$router->group(['middleware' => 'auth:api'], function ($router) {
    $router->get('/always/true', function () {
        return response()->json(['ok' => 'ok']);
    });
});


$router->get('/test', function() {
    return response()->json([
        'message' => 'Ce hello world vient de l\'API'
    ]);
});


