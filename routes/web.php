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


$router->get('/Subject/All', 'SubjectController@getAll');
$router->post('/Subject/Add', 'SubjectController@createSubject');
$router->get('Ue/All', 'UeController@getAll');
$router->post('Ue/Add', 'UeController@createUe');



/** Grades */
$router->get('/Grade/All', 'GradeController@getAll');

$router->post('/Grade/Show/Promo/Semester', 'GradeController@getGradesPromoSemester');
$router->post('/Grade/Show/Promo/Ue', 'GradeController@getGradesPromoSemester');


// /** Supposedly prefixed with the name of the student or user */
// $router->get('/Grade/All', 'GradeController@getGradesStudent');
// $router->post('/Grade/Show/{subject_id}', 'GradeController@getGradesStudentSubject');
// $router->post('/Grade/Show/{ue_id}','GradeController@getGradesStudentUe');
// $router->post('/Grade/Show/{semester}','GradeController@getGradesStudentSemester');

// $router->get('/Grade/Add', 'GradeController@addGrade');
// $router->get('/Grade/Update/{grade_id}', 'GradeController@updateGrade');
// $router->get('/Grade/Delete/{grade_id}', 'GradeController@deleteGrade');

