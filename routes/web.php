<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->intended('home');
    }
    return view('welcome');
});

Auth::routes();
Route::post ('/login',    'Auth\LoginController@authenticate');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home','HomeController@index');
    Route::post  ('/lesson/{lesson}/comment/save',   'LessonController@saveComment');
    Route::resource('lesson', 'LessonController',
    [
        'only' => [
            'show',
            'store'
        ],
    ]);
});

Route::resource('subjects', 'SubjectController',
[
    'only' => [
        'index',
        'store',
    ],
    'names' => [
        'store' => 'subject.store'
    ]
]);

Route::resource('exam', 'ExamController',
[
    'only' => [
        'index',
        'store',
        'update'
    ],
]);

Route::get('/subject/{id}/lessons','SubjectController@indexLessons');

Route::group(['prefix' => 'parent', 'middleware' => ['auth','role:parent']], function() {

    Route::get  ('/',                               'ParentController@home');
    Route::get  ('/lessons',                        'LessonController@index');
    Route::get  ('/grades',                         'GradeController@index');


});

Route::group(['prefix' => 'student', 'middleware' => ['auth','role:student']], function() {

    Route::get  ('/',                               'StudentController@home');
    Route::get  ('/subjects',                       'StudentController@subjects');
    Route::get  ('/subject/{id}/lessons',           'StudentController@subjectLessons');

    Route::get  ('/quizzes',                        'QuizController@index');
    Route::get  ('/quiz/{id}',                      'QuizController@show');
    Route::get  ('/quiz/{id}/question/{q}',         'QuizController@show');
    Route::post ('/quiz/{id}/question/{q}/submit',  'QuizController@submitAnswer');

    Route::get  ('/exams',                          'ExamController@index');
    Route::get  ('/exam/{id}',                      'ExamController@show');
    Route::get  ('/exam/{id}/question/{q}',         'ExamController@show');
    Route::post ('/exam/{id}/question/{q}/submit',  'ExamController@submitAnswer');

    Route::get  ('/grades',                          'GradeController@index');

});


Route::group(['prefix' => 'teacher', 'middleware' => ['auth','role:teacher']], function() {

    Route::get  ('/',                       'TeacherController@home');

    Route::get  ('/subjects',               'TeacherController@subjects');
    Route::get  ('/subject/{id}/lessons',   'TeacherController@subjectView');

    Route::get  ('/subject/new',            'TeacherController@subjectCreate');
    Route::get  ('/subject/{id}/edit',      'SubjectController@edit');
    Route::post ('/subject/{id}/update',    'SubjectController@update');
    Route::get  ('/subject/{id}/delete',    'SubjectController@destroy');

    Route::get  ('/subject/{id}/lesson/new','TeacherController@lessonCreate');
    Route::get  ('/lesson/{id}/edit',      'LessonController@edit');
    Route::post ('/lesson/{id}/update',      'LessonController@update');
    Route::get  ('/lesson/{id}/delete',    'LessonController@destroy');

    Route::get  ('/exams',    'ExamController@index');
    Route::get  ('/exam/new',    'ExamController@create');
    Route::get  ('/exam/{id}',    'ExamController@show');
    Route::get  ('/exam/{id}/edit',    'ExamController@edit');
    Route::post ('/exam/{id}/update',    'ExamController@update');
    Route::get  ('/exam/{id}/delete',    'ExamController@destroy');

    Route::get  ('/quizzes',    'QuizController@index');
    Route::get  ('/quiz/new',    'QuizController@create');
    Route::get  ('/quiz/{id}',    'QuizController@show');
    Route::get  ('/quiz/{id}/edit',    'QuizController@edit');
    Route::post ('/quiz/store',    'QuizController@store');
    Route::post ('/quiz/{id}/update',    'QuizController@update');
    Route::get  ('/quiz/{id}/delete',    'QuizController@destroy');

    Route::get  ('/students',    'StudentController@index');
    Route::get  ('/students/overview',    'StudentController@indexOverview');
    Route::get  ('/student/{id}/edit',    'StudentController@edit');
    Route::get  ('/student/create',    'StudentController@create');
    Route::post  ('/student/save',    'StudentController@store');
    Route::get  ('/student/{id}/delete',    'StudentController@destroy');
    Route::post  ('/student/{id}/update',    'StudentController@update');

    Route::get  ('/student/{id}/parent/create',     'ParentController@create');
    Route::post ('/student/{id}/parent/save',       'ParentController@store');
    Route::get  ('/student/{id}/parent/edit',       'ParentController@edit');
    Route::post ('/student/{id}/parent/update',     'ParentController@update');
    // Route::get  ('/student/{id}/parent/delete',     'StudentController@destroy');

    Route::get  ('/student/{id}/grades/edit',       'GradeController@edit');
    Route::post  ('/student/{id}/grades/save',       'GradeController@update');


});
