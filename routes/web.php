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

use App\User;

Route::get('/',  'HomeController@index')->name('dashboard');

Route::group(['middleware' => ['role:super-admin']], function () {

    Route::resource('settings/users', 'Settings\UsersController')->middleware('auth');

    Route::get('settings/users/{user}/roles', 'Settings\UsersController@roles')->name('user.roles')->middleware('auth');

    Route::post('settings/users/{user}/giveRoles', 'Settings\UsersController@giveRole')->name('user.giveRoles')->middleware('auth');

    Route::get('settings/userGroups', 'Settings\UsersController@getGroups');
      
    Route::get('settings/profile/{user}', 'Settings\ProfilesController@show')->name('user.profile');

});

Route::group(['middleware' => ['role:super-admin|admin']], function () {    
    Route::resource('role', 'Settings\RolesController')->middleware('auth');
    Route::get('role/{role}/permission', 'Settings\RolesController@permission')->middleware('auth');
    Route::post('role/{role}/permission', 'Settings\RolesController@givePermission')->name('give.permission')->middleware('auth');

    Route::get('settings/getRoles', 'Settings\RolesController@getRoles');
    Route::get('roles/permission', 'Settings\RolesController@rolePermission');

    Route::resource('settings/permission', 'Settings\PermissionsController')->middleware('auth');
    Route::get('settings/getPermissions', 'Settings\PermissionsController@getPermissions');
    Route::resource('settings/group', 'Settings\GroupsController');

    // Test routes begin
    Route::get('settings/test', 'Settings\TestsController@index')->name('settings.test');
    Route::get('settings/test/create', 'Settings\TestsController@create')->name('settings.test.create');
    Route::post('settings/test/store', 'Settings\TestsController@store')->name('settings.test.store');
    Route::get('settings/test/{test}/edit', 'Settings\TestsController@edit')->name('settings.test.edit');
    Route::put('settings/test/{test}', 'Settings\TestsController@update')->name('settings.test.update');
    Route::get('settings/test/{test}/show', 'Settings\TestsController@show')->name('settings.test.show');
    Route::delete('settings/test/{test}', 'Settings\TestsController@destroy')->name('settings.test.destroy');
    
    Route::get('settings/test/import', 'Settings\TestsController@import')->name('settings.test.import');
    Route::post('settings/test/import', 'Settings\TestsController@importExcel')->name('test.importExcel');
    
    /* Quizes here */
    Route::get('settings/quiz/{test}', 'Settings\QuizzesController@index')->name('quiz.index');
    Route::get('settings/quiz/{test}/create', 'Settings\QuizzesController@create')->name('quiz.create');
    Route::post('settings/quiz/store', 'Settings\QuizzesController@store')->name('quiz.store');

    Route::get('settings/quiz/{test}/{quiz}/show', 'Settings\QuizzesController@show')->name('quiz.show');
    Route::get('settings/quiz/{test}/{quiz}/edit', 'Settings\QuizzesController@edit')->name('quiz.edit');
    Route::put('settings/quiz/{quiz}', 'Settings\QuizzesController@update')->name('quiz.update');
    Route::delete('settings/quiz/{quiz}', 'Settings\QuizzesController@destroy')->name('quiz.destroy');
    /* End Quiz */

    /* Answer */
    Route::get('settings/answer/{quiz}', 'Settings\AnswersController@index')->name('answer.index');
    Route::get('settings/answer/{quiz}/create', 'Settings\AnswersController@create')->name('answer.create');
    Route::post('settings/answer/store', 'Settings\AnswersController@store')->name('answer.store');

    Route::get('settings/answer/{answer}/show', 'Settings\AnswersController@show')->name('answer.show');
    Route::get('settings/answer/{answer}/edit', 'Settings\AnswersController@edit')->name('answer.edit');
    Route::put('settings/answer/{answer}', 'Settings\AnswersController@update')->name('answer.update');
    Route::delete('settings/answer/{answer}', 'Settings\AnswersController@destroy')->name('answer.destroy');
    /* end Answer */ 

    // Participants
    Route::post('participants/avatar', 'ParticipantsController@avatar')->name('avatar');
    Route::get('groups/list', 'ParticipantsController@fetchGroup');
    Route::get('participants/create', 'ParticipantsController@create')->name('participants.create');
    Route::get('participants/index', 'ParticipantsController@index')->name('participants.index');

    Route::get('participants/destroy/{id}', 'ParticipantsController@destroy');
    Route::get('/participants/import', 'ParticipantsController@import')->name("participants.import");
    Route::post('participants/store', 'ParticipantsController@store')->name('participant.store');    
    Route::get('participants/fetchGroup', 'ParticipantsController@fetch_groups');
    Route::get('participants/assessment', 'ParticipantsController@assessment_table')->name('participants.assessment');
    Route::post('participants/addToGroup', 'ParticipantsController@addToGroup')->name('participants.addToGroup');
    
    Route::resource('test', 'TestsController');

    Route::get('participants/deleteMultiple', 'ParticipantsController@deleteMultiple')->name('participants.deleteMultiple');

    // Route::resource('/participants', 'ParticipantsController')->middleware('auth');
    Route::get('/participants/{user}/edit', 'ParticipantsController@edit')->name('participants.edit');    

    Route::get('/participants/list', 'ParticipantsController@list')->name('participants.list');
    Route::post('/participants/store', 'ParticipantsController@store')->name('participants.store');
    Route::put('/participants/{user}', 'ParticipantsController@update')->middleware('auth')->name('participants.update');
    Route::get('/participants/{user}', 'ParticipantsController@show')->middleware('auth')->name('participants.show');
    Route::delete('/participants/{user}', 'ParticipantsController@destroy')->name('participants.destroy');
    // Route::resource('/participants', 'ParticipantsController')->middleware('auth');

    // Route::get('participants/destroy/{id}', 'ParticipantsController@destroy');

    // Route::get('participants/create', 'ParticipantsController@create')->name('participants.create');

    // Route::post('participants/store', 'ParticipantsController@store')->name('participant.store');

    // Route::get('/participants/{id}edit', 'ParticipantsController@edit')->name('participant.edit');

    // Route::get('/participants/show/{id}', 'ParticipantsController@show');
});

Route::get('skills',  function(){

    return [ 'label'=> ['laravel', 'vue', 'php']];

});

Route::resource('test', 'TestsController');

Route::get('settings/profile/{user}', 'Settings\ProfilesController@show')->name('user.profile')->middleware('auth');
Route::get('settings/profile/{user}/edit', 'Settings\ProfilesController@edit')->name('edit.profile')->middleware('auth');