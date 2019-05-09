<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('user', 'AuthController@user');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'v1'
], function ($router) {
    Route::resource('dashboard', 'DashboardController');
    Route::resource('assignments', 'AssignmentsController');
    Route::resource('calendar', 'CalendarController');
    //Route::resource('admin.subject', 'SubjectController');
});
Route::group([
    'middleware' => ['auth:api', 'can:admin'],
    'prefix' => 'v1/admin'
], function ($router) {
    Route::resource('courses', 'AdminController\CourseController');
    Route::resource('subjects', 'AdminController\SubjectController');
    Route::resource('assign', 'AdminController\AssignController');
    Route::resource('users', 'AdminController\UserController');
    Route::resource('classroom', 'AdminController\ClassroomController');
});