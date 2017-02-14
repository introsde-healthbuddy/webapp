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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

Route::resource('/', 'HomeController');
Route::resource('health-monitor', 'HealthMonitorController');
Route::resource('nutrition', 'NutritionController');
Route::resource('activities', 'ActivityController');
Route::resource('goals', 'GoalController');
Route::resource('settings', 'SettingsController');
Route::get('home', 'HomeController@index');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

});