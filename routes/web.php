<?php

use App\Http\Middleware\UserMiddleware;

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
    $router->get('/role', 'UserController@isAdmin');
});

$router->group([
    'middleware' => 'auth:api',
    'prefix' => 'students',
], function($router) {
    $router->get('/{studentId}', 'StudentController@getStudent');
});

$router->group([
    'middleware' => 'auth:api',
    'prefix' => 'grades',
], function($router) {
    $router->post('/add', 'GradeController@addGrade');

    $router->get('/students/{student_id}', 'GradeController@getGradesStudent');
    $router->get('/students/{student_id}/subjects/{subject_id}', 'GradeController@getGradesStudentSubject');
    $router->get('/students/{student_id}/ues/{ue_id}', 'GradeController@getGradesStudentUe');
    $router->get('/students/{student_id}/semesters/{semester}', 'GradeController@getGradesStudentSemester');

    $router->get('/promos/{year}','GradeController@getGradesPromo');
    $router->get('/promos/{year}/subjects/{subject_id}', 'GradeController@getGradesPromoSubject');
    $router->get('/promos/{year}/ues/{ue_id}', 'GradeController@getGradesPromoUe');
    $router->get('/promos/{year}/semesters/{semester}', 'GradeController@getGradesPromoSemester');
});

$router->group([
    'middleware' => 'auth:api',
    'prefix' => 'assignments',
], function($router) {
    $router->post('/add', 'AssignmentController@addAssignment');
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
    $router->get('/', 'UeController@getAllUes');
    $router->get('/semesters/{semesterId}', 'UeController@getUesBySemester');
});

$router->group([
    'middleware' => 'auth:api',
    'prefix' => 'subjects',
], function($router) {
    $router->get('/ues/{ueId}', 'SubjectController@getSubjectsByUe');
    $router->get('/semesters/{semestrerId}', 'SubjectController@getSubjectsBySemester');
    //Cette fonction ne marche pas
    $router->get('/promos/{year}', 'SubjectController@getSubjectsByPromo');
    //Cette fonction est un test (infructueux)
    $router->get('/test/', 'SubjectController@test');
});

$router->group(['middleware' => 'auth:api'], function ($router) {
    $router->get('/always/true', function () {
        return response()->json(['ok' => 'ok']);
    });
    $router->post('/always/true', function () {
        return response()->json(['ok' => 'ok']);
    });
    $router->put('/always/true', function () {
        return response()->json(['ok' => 'ok']);
    });
    $router->patch('/always/true', function () {
        return response()->json(['ok' => 'ok']);
    });
}); 