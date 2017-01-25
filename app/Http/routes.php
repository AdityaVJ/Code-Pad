<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//GET routes added

//Home page
Route::get(
    '/', function () {
        return view('dashboard');
    }
);

Route::resource('events', 'Event\EventController');

Route::resource('event/programs', 'Event\ProgramController');

Route::resource('users', 'Teacher\TeacherController');

Route::resource('students', 'Student\StudentController');

Route::get('/reset', 'HomeController@index');
// User login
Route::get('/login', 'UserController@login');
// User register
Route::get('/register', 'UserController@register');
// after login/register
Route::get('/home', 'UserController@home');
// for logout
Route::get('/logout', 'UserController@logout');
// Student Profile
Route::get('/admin', 'UserController@admin');

Route::get('/check/{code}', 'Event\EventController@checkCode');
Route::get('/event/delete/{code}', 'Event\EventController@destroy');



Route::group(
    ['namespace' => 'Admin', 'prefix' => 'admin'], function () {
        Route::get(
            'check/{id}', [
            'uses' => 'AdminController@checkCode'
            ]
        );
        Route::get(
            'delete/{id}', [
            'uses' => 'AdminController@delete'
            ]
        );
        Route::get(
            'Admin', [
            'uses' => 'AdminController@addAdmin'
            ]
        );
        Route::get(
            'Admin/Show', [
            'uses' => 'AdminController@showAdmin'
            ]
        );
        Route::post(
            'Admin', [
            'uses' => 'AdminController@addAdmindata'
            ]
        );
        Route::get(
            'Admin/{id}', [
            'uses' => 'AdminController@editAdmin'
            ]
        );
        Route::post(
            'Admin/edit/{id}', [
            'uses' => 'AdminController@updateAdmin'
            ]
        );
        Route::get(
            'Student', [
            'uses' => 'AdminController@addStudent'
            ]
        );
        Route::get(
            'Student/Show', [
            'uses' => 'AdminController@showStudent'
            ]
        );
        Route::post(
            'Student', [
            'uses' => 'AdminController@addStudentdata'
            ]
        );
        Route::get(
            'Student/{id}', [
            'uses' => 'AdminController@editStudent'
            ]
        );
        // Route::delete('Student/{id}', [
        //     'uses' => 'AdminController@editStudent'
        // ]);
        Route::delete(
            'Student/{id}', function () {
                return "Helo";
            }
        );
        Route::post(
            'Student/edit/{id}', [
            'uses' => 'AdminController@updateStudent'
            ]
        );

        Route::get(
            'Teacher', [
            'uses' => 'AdminController@addTeacher'
            ]
        );
        Route::get(
            'Teacher/Show', [
            'uses' => 'AdminController@showTeacher'
            ]
        );
        Route::post(
            'Teacher', [
            'uses' => 'AdminController@addTeacherdata'
            ]
        );
        Route::get(
            'Teacher/{id}', [
            'uses' => 'AdminController@editTeacher'
            ]
        );
        // Route::delete('Teacher/{id}', [
        //     'uses' => 'AdminController@editTeacher'
        // ]);
        Route::delete(
            'Teacher/{id}', function () {
                return "Helo";
            }
        );
        Route::post(
            'Teacher/edit/{id}', [
            'uses' => 'AdminController@updateTeacher'
            ]
        );

    }
);

Route::group(
    ['namespace' => 'Student'], function () {

        Route::get(
            '/contest/{id}', [
            'uses' => 'StudentController@contest'
            ]
        );
        Route::get(
            '/event/register/{code}', [
            'uses' => 'StudentController@eventRegister'
            ]
        );
    }
);

Route::post('/compile/{code}/{id}', 'ProgramController@compile');

Route::post('/runcode/{code}/{id}', 'ProgramController@runstatus');

Route::get('/leaderboard/{code}', 'ProgramController@leaderboard');





Route::get('/write', 'ProgramController@writeFile');
//Error
Route::get(
    '/error', function () {
        return view('errors.503');
    }
);
Route::get(
    '/{id}', function () {
        return view('errors.503');
    }
);





// POST routes added
Route::post('/admin_login', 'UserController@adminLogin');
Route::post('/student/login', 'Student\StudentController@login');    // Check Student login details


Route::post('/user/login', 'Teacher\TeacherController@login');    // Check Teacher login details

Route::post('/check', 'ProgramController@snippet');



