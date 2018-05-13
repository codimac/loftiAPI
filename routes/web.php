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
   $test_admin = $router->get('/me', 'UserController@getAuthUser');
   if($test_admin.role_id == '1'){
        $router->post('/grades', 'GradeController@addGradesPromo');
        $router->put('/grades/{grade_id}', 'GradeController@updateGrade');
        $router->delete('/grades/{grade_id}', 'GradeController@deleteGrade');
   }
   else{
       $router->post('/grades', function($router) {
           return response()->json([
               'message' => 'Vous ne pouvez pas faire ça'
           ]);
       });
        $router->put('/grades/{grade_id}', function($router) {
           return response()->json([
               'message' => 'Vous ne pouvez pas faire ça'
           ]);
       });
        $router->delete('/grades/{grade_id}', function($router) {
           return response()->json([
               'message' => 'Vous ne pouvez pas faire ça'
           ]);
       });
   }
});

// $router->group(['middleware' => 'auth:api'], function ($router) {
//     $router->get('/always/true', function () {
//         return response()->json(['ok' => 'ok']);
//     });
// });

$router->get('/test', function() {
    return response()->json([
        'message' => 'Ce hello world vient de l\'API'
    ]);
});


// $router->get('/Subject/All', 'SubjectController@getAll');
// $router->post('/Subject/Add', 'SubjectController@createSubject');
// $router->get('Ue/All', 'UeController@getAll');
// $router->post('Ue/Add', 'UeController@createUe');



/** Grades */
$router->get('/grades', 'GradeController@getAll');

// $router->post('/Grade/Show/Promo/Subject', 'GradeController@getGradesPromoSubject');
// $router->post('/Grade/Show/Promo/Ue', 'GradeController@getGradesPromoUe');
// $router->post('/Grade/Show/Promo/Semester', 'GradeController@getGradesPromoSemester');



// /** Supposedly prefixed with the name of the student or user */
// $router->get('/Grade/All', 'GradeController@getGradesStudent');




