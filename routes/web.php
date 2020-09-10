<?php

use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => ['role:super-admin']], function () {
    // Route::get('/admin', 'Admin\UsersController@index')->name('admin');
    Route::resource('settings/users', 'Settings\UsersController')->middleware('auth');
    Route::get('settings/users/{user}/roles', 'Settings\UsersController@roles')->name('user.roles')->middleware('auth');
    Route::post('settings/users/{user}/giveRoles', 'Settings\UsersController@giveRole')->name('user.giveRoles')->middleware('auth');
});

Route::group(['middleware' => ['role:super-admin|admin']], function () {
    Route::resource('role', 'Settings\RolesController')->middleware('auth');
    Route::get('role/{role}/permission', 'Settings\RolesController@permission')->middleware('auth');
    Route::post('role/{role}/permission', 'Settings\RolesController@givePermission')->name('give.permission')->middleware('auth');
    Route::resource('settings/permission', 'Settings\PermissionsController')->middleware('auth');
    Route::get('settings/getPermissions', 'Settings\PermissionsController@getPermissions')->middleware('auth');

    Route::resource('settings/group', 'Settings\GroupsController');

<<<<<<< HEAD
    Route::get('/settings/tests', 'Settings\TestsController@index')->name('test')->middleware('auth');
    Route::get('/settings/tests/create', 'Settings\TestsController@create')->name('create.test');
    Route::post('/settings/tests/create', 'Settings\TestsController@store')->name('save.test');
    Route::post('participants/import_excel', 'ParticipantsController@import_excel');
    Route::get('/settings/tests/{user}', 'Settings\TestsController@show');
    Route::get('/settings/tests/{user}/edit', 'Settings\TestsController@edit');
    Route::put('/settings/tests/{user}', 'Settings\TestsController@update');
    Route::delete('/settings/tests/{user}', 'Settings\TestsController@destroy')->name('destroy.user');
    Route::get('/participants/import', 'ParticipantsController@import')->name("participants.import");
=======
    Route::get('settings/test', 'Settings\TestsController@index')->name('settings.test');    
    Route::get('settings/test/create', 'Settings\TestsController@create')->name('settings.test.create');    

    Route::post('settings/test/store', 'Settings\TestsController@store')->name('settings.test.store');

    Route::get('settings/test/{test}/edit', 'Settings\TestsController@edit')->name('settings.test.edit');
    Route::put('/settings/test/{test}', 'Settings\TestsController@update')->name('settings.test.update');
    Route::get('settings/test/{test}/show', 'Settings\TestsController@show')->name('settings.test.show');    
    Route::delete('/settings/test/{test}', 'Settings\TestsController@destroy')->name('settings.test.destroy');
    

    Route::resource('test', 'TestsController');
    
>>>>>>> origin/ganaa
    Route::resource('/participants', 'ParticipantsController')->middleware('auth');
    Route::get('participants/destroy/{id}', 'ParticipantsController@destroy');
    Route::post('participants/update/{id}', 'ParticipantsController@update');
    Route::get('/participants/show/{id}', 'ParticipantsController@show');
});

Route::get('skills',  function(){

    return [ 'label'=> ['laravel', 'vue', 'php']];

});
