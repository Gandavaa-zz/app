<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',  'HomeController@index')->name('dashboard');

// Route::group(['middleware' => ['role:super-admin']], function () {
    // Route::get('/admin', 'Admin\UsersController@index')->name('admin');
    Route::resource('settings/users', 'Settings\UsersController')->middleware('auth');    
    Route::get('settings/users/{user}/roles', 'Settings\UsersController@roles')->name('user.roles')->middleware('auth');
    Route::post('settings/users/{user}/giveRoles', 'Settings\UsersController@giveRole')->name('user.giveRoles')->middleware('auth');
// });

Route::resource('role', 'Settings\RolesController')->middleware('auth');
Route::get('role/{role}/permission', 'Settings\RolesController@permission')->middleware('auth');
Route::post('role/{role}/permission', 'Settings\RolesController@givePermission')->name('give.permission')->middleware('auth');
Route::resource('settings/permission', 'Settings\PermissionsController')->middleware('auth');

Route::get('/settings/tests', 'Settings\TestsController@index')->name('test')->middleware('auth');
Route::get('/settings/tests/create', 'Settings\TestsController@create')->name('create.test');
Route::post('/settings/tests/create', 'Settings\TestsController@store')->name('save.test');
Route::get('/settings/tests/{user}', 'Settings\TestsController@show');
Route::get('/settings/tests/{user}/edit', 'Settings\TestsController@edit');
Route::put('/settings/tests/{user}', 'Settings\TestsController@update');
Route::delete('/settings/tests/{user}', 'Settings\TestsController@destroy')->name('destroy.user');

Route::get('/admin/participants', 'Admin\ParticipantsController@index')->name('participants')->middleware('auth');
Route::get('/admin/participants/create', 'Admin\ParticipantsController@index')->name('create.participants');
Route::post('/admin/participants/create', 'Admin\ParticipantsController@index')->name('save.participants');
Route::get('/admin/participants/{user}', 'Admin\ParticipantsController@index');
Route::get('/admin/participants/{user}/edit', 'Admin\ParticipantsController@index');
Route::put('/admin/participants/{user}', 'Admin\ParticipantsController@index');
Route::delete('/admin/participants/{user}', 'Admin\ParticipantsController@index')->name('destroy.participants');
