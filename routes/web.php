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



$router->get('/grades/{student_id}', 'GradeController@getGradesStudent');
$router->get('/grades/{student_id}/{subject_id}', 'GradeController@getGradesStudentSubject');
$router->get('/grades/{student_id}/{ue_id}', 'GradeController@getGradesStudentUe');
$router->get('/grades/{student_id}/{semester}', 'GradeController@getGradesStudentSemester');

$router->get('/grades/{promo}/{subject_id}', 'GradeController@getGradesPromoSubject');
$router->get('/grades/{promo}/{ue_id}', 'GradeController@getGradesPromoUe');
$router->get('/grades/{promo}/{semester}', 'GradeController@getGradesPromoSemester');


// $router->group(['middleware' => 'auth:api'], function ($router) {
//     $router->get('/always/true', function () {
//         return response()->json(['ok' => 'ok']);
//     });
// });




// $router->get('/Subject/All', 'SubjectController@getAll');
// $router->post('/Subject/Add', 'SubjectController@createSubject');
// $router->get('Ue/All', 'UeController@getAll');
// $router->post('Ue/Add', 'UeController@createUe');






