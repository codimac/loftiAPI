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


$router->get('/test', function() {
    return response()->json([
        'message' => 'Ce hello world vient de l\'API'
    ]);
});


$router->group(['prefix' => 'auth'], function($router) {
    $router->post('/signin', 'AuthController@signIn');
});

$router->group([
    'middleware' => 'auth:api',
    'prefix' => 'users',
], function($router) {
   $test_admin = $router->get('/me', 'UserController@getAuthUser');
//    if($test_admin.role_id == '1'){
//         $router->post('/grades', 'GradeController@addGradesPromo');
//         $router->put('/grades/{grade_id}', 'GradeController@updateGrade');
//         $router->delete('/grades/{grade_id}', 'GradeController@deleteGrade');
//    }
//    else{
//        $router->post('/grades', function($router) {
//            return response()->json([
//                'message' => 'Vous ne pouvez pas faire ça'
//            ]);
//        });
//         $router->put('/grades/{grade_id}', function($router) {
//            return response()->json([
//                'message' => 'Vous ne pouvez pas faire ça'
//            ]);
//        });
//         $router->delete('/grades/{grade_id}', function($router) {
//            return response()->json([
//                'message' => 'Vous ne pouvez pas faire ça'
//            ]);
//        });
//    }
});


$router->group([
    'middleware' => 'auth:api',
    'prefix' => 'grades',
], function($router) {
    $router->get('/{student_id}', 'GradeController@getGradesStudent');
    $router->get('/{student_id}/subject/{subject_id}', 'GradeController@getGradesStudentSubject');
    $router->get('/{student_id}/ue/{ue_id}', 'GradeController@getGradesStudentUe');
    $router->get('/{student_id}/semester/{semester}', 'GradeController@getGradesStudentSemester');
    $router->get('/{promo}/subject/{subject_id}', 'GradeController@getGradesPromoSubject');
    $router->get('/{promo}/ue/{ue_id}', 'GradeController@getGradesPromoUe');
    $router->get('/{promo}/semester/{semester}', 'GradeController@getGradesPromoSemester');
});








// $router->group(['middleware' => 'auth:api'], function ($router) {
//     $router->get('/always/true', function () {
//         return response()->json(['ok' => 'ok']);
//     });
// });




// $router->get('/Subject/All', 'SubjectController@getAll');
// $router->post('/Subject/Add', 'SubjectController@createSubject');
// $router->get('Ue/All', 'UeController@getAll');
// $router->post('Ue/Add', 'UeController@createUe');






$router->get('/me', 'UserController@getAuthUser');
//$router->post('/create', 'UserController@createUser');
//$router->put('/update/{id}', 'UserController@updateUser');


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
    //Cette fonction ne marche pas
    $router->get('/promos/{year}', 'SubjectController@getSubjectsByPromo');
});
