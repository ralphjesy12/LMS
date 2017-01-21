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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home','HomeController@index');

    Route::resource('lesson', 'LessonController',
    [
        'only' => [
            'show',
        ],
    ]);
});



Route::group(['middleware' => ['auth','role:student']], function () {
    Route::get('/home/subjects', 'StudentController@subjects');
});
Route::group(['middleware' => ['auth','role:teacher']], function () {
    Route::get('/home/subjects', ['middleware' => ['role:teacher'], 'uses' => 'TeacherController@subjects']);
    Route::get('/home/subject/new', ['middleware' => ['role:teacher'], 'uses' => 'TeacherController@subjectCreate']);
    Route::get('/home/subject/{id}', ['middleware' => ['role:teacher'], 'uses' => 'TeacherController@subjectView']);
});


Route::resource('subjects', 'SubjectController',
[
    'only' => [
        'index',
        'store'
    ],
    'names' => [
        'store' => 'subject.store'
    ]
]);

Route::get('/subject/{id}/lessons','SubjectController@indexLessons');

Route::group(['prefix' => 'artisan'], function () {
    //Clear Cache facade value:
    Route::get('/clear-cache', function() {
        $exitCode = Artisan::call('cache:clear');
        return '<h1>Cache facade value cleared</h1>';
    });

    //Reoptimized class loader:
    Route::get('/optimize', function() {
        $exitCode = Artisan::call('optimize');
        return '<h1>Reoptimized class loader</h1>';
    });

    //Clear Route cache:
    Route::get('/route-cache', function() {
        $exitCode = Artisan::call('route:cache');
        return '<h1>Route cache cleared</h1>';
    });

    //Clear View cache:
    Route::get('/view-clear', function() {
        $exitCode = Artisan::call('view:clear');
        return '<h1>View cache cleared</h1>';
    });

    //Clear Config cache:
    Route::get('/config-cache', function() {
        $exitCode = Artisan::call('config:cache');
        return '<h1>Clear Config cleared</h1>';
    });

});


Route::group(['prefix' => 'student', 'middleware' => ['auth','role:student']], function() {
    Route::get('/', 'StudentController@home');
    Route::get('/subjects', 'StudentController@subjects');
    Route::get('/subject/{id}/lessons', 'StudentController@subjectLessons');
});
