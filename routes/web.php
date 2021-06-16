<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('dashboard');

Route::group(['middleware' => ['role:super-admin']], function () {
    Route::get('settings/users/import', 'Settings\UsersController@import')->name('user.import');
    Route::resource('settings/users', 'Settings\UsersController')->middleware('auth');
    Route::get('settings/users/{user}/roles', 'Settings\UsersController@roles')->name('user.roles')->middleware('auth');
    Route::post('settings/users/{user}/giveRoles', 'Settings\UsersController@giveRoles')->name('user.giveRoles')->middleware('auth');
    Route::get('settings/userGroups', 'Settings\UsersController@getGroups');
    Route::get('settings/profile/{user}', 'Settings\ProfilesController@show')->name('user.profile');

    Route::resource('role', 'Settings\RolesController')->middleware('auth');
    Route::get('role/{role}/permission', 'Settings\RolesController@permission')->middleware('auth');
    Route::post('role/{role}/permission', 'Settings\RolesController@givePermission')->name('give.permission')->middleware('auth');
    Route::get('settings/getRoles', 'Settings\RolesController@getRoles');
    Route::get('roles/permission', 'Settings\RolesController@rolePermission');
    Route::resource('settings/permission', 'Settings\PermissionsController')->middleware('auth');
    Route::get('settings/getPermissions', 'Settings\PermissionsController@getPermissions');
    Route::resource('settings/group', 'Settings\GroupsController');
});

Route::get('translations/new', 'TranslationsController@new')->name('translations.new')->middleware('auth');
Route::get('translations/add', 'TranslationsController@add')->name('translations.add')->middleware('auth');
Route::post('translations/save', 'TranslationsController@saveTranslations')->name('translations.save')->middleware('auth');
Route::resource('translations', 'TranslationsController');

Route::group(['middleware' => ['role:super-admin|admin']], function () {
    // get test API controller
    Route::resource('testapi', 'TestApiController');
    Route::get('translation/getJSON/{test_id}', 'TranslationsController@getJSON');
    Route::get('reports/getXml/{assessment_id}/{test_id}', 'ReportsController@getXml');
    Route::get('reports/getHtml/{id}', 'ReportsController@getHtml');
    Route::get('reports/result/{assessment_id}', 'ReportsController@result');
    Route::get('reports/global/{assessment_id}', 'ReportsController@global');
    Route::get('reports/factory/{assessment_id}', 'ReportsController@factory');
    Route::get('reports/groups/{assessment_id}', 'ReportsController@groups');
    Route::get('reports/referential/{assessment_id}', 'ReportsController@referential');


    Route::get('assessment/salesProfile/{assessment_id}', 'AssessmentsController@salesProfile');

    Route::resource('assessment', 'AssessmentsController');

    Route::get('candidate/assessment', 'CandidatesController@assessment')->name('candidate.assessment');
    Route::resource('candidate', 'CandidatesController');

    Route::get('candidate/group', 'CandidatesController@group')->name('candidate.group');
    Route::get('candidate/deleteMultiple', 'CandidatesController@deleteMultiple')->name('candidate.deleteMultiple');

    // Candidate
    Route::get('api/assessments/{candidate_id}', 'ApiController@assessments');
    Route::get('api/import', 'ApiController@import')->name('Api.import');
    Route::get('api/retrieve', 'ApiController@retrieve');
    Route::get('api/token', 'ApiController@getToken');
    Route::get('api/group', 'ApiController@group');
    Route::get('api/contract', 'ApiController@contract');
    Route::get('api/company', 'ApiController@getCompany');
    Route::get('api/tests', 'ApiController@getTest');
    Route::get('api/import', 'ApiController@import');
    Route::get('api/getList', 'ApiController@testList');

    // SETTINGS Controller
    Route::resource('role', 'Settings\RolesController')->middleware('auth');
    Route::get('role/{role}/permission', 'Settings\RolesController@permission')->middleware('auth');
    Route::post('role/{role}/permission', 'Settings\RolesController@givePermission')->name('give.permission')->middleware('auth');
    Route::get('settings/getRoles', 'Settings\RolesController@getRoles');
    Route::get('roles/permission', 'Settings\RolesController@rolePermission');
    Route::resource('settings/permission', 'Settings\PermissionsController')->middleware('auth');
    Route::get('settings/getPermissions', 'Settings\PermissionsController@getPermissions');
    Route::resource('settings/group', 'Settings\GroupsController');

    Route::resource('test', 'TestsController');
});

Route::get('skills', function () {
    return ['label' => ['laravel', 'vue', 'php']];
});

Route::get('settings/profile/{user}', 'Settings\ProfilesController@show')->name('user.profile')->middleware('auth');
Route::get('settings/profile/{user}/edit', 'Settings\ProfilesController@edit')->name('edit.profile')->middleware('auth');
