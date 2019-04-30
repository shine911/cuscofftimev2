<?php
use App\Http\Controllers\Auth\LoginController;

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

Route::group(['middleware' => 'auth'], function () {
    Route::resources([
        '/' => 'HomeController',
        'assignments' => 'AssignmentsController',
        'calendar' => 'CalendarController'
    ]);
});

Route::resource('login', 'LoginController')->name('index', 'login');
Route::get('logout', 'LoginController@logout');

