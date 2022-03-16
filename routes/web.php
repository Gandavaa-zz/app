<?php

use App\Http\Controllers\AssessmentsController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('dashboard')->middleware('auth');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/report/pdf', [AssessmentsController::class, 'generatePDF']);
Route::group(['middleware' => ['role:super-admin']], function () {
    Route::get('settings/users/import', 'Settings\UsersController@import')->name('user.import');    
    Route::get('settings/users/{user}/roles', 'Settings\UsersController@roles')->name('user.roles')->middleware('auth');
    Route::post('settings/users/{user}/giveRoles', 'Settings\UsersController@giveRoles')->name('user.giveRoles')->middleware('auth');
    Route::get('settings/userGroups', 'Settings\UsersController@getGroups');    
});

Route::group(['middleware' => ['role:super-admin|admin']], function () {    
    // get test API controller
    Route::resource('test', 'TestsController');
    Route::get('translation/getJSON/{test_id}', 'TranslationsController@getJSON');
    Route::get('assessment/pdf', 'AssessmentsController@pdf');

    Route::get('assessment/report/{assessment_id}', 'AssessmentsController@report');
    Route::get('assessment/salesProfile/{assessment_id}', 'AssessmentsController@salesProfile');
    Route::resource('assessment', 'AssessmentsController');

    Route::get('candidate/assessment', 'CandidatesController@assessment')->name('candidate.assessment');
    Route::get('candidate/group', 'CandidatesController@group')->name('candidate.group');
    Route::resource('candidate', 'CandidatesController');
    Route::get('candidate/deleteMultiple', 'CandidatesController@deleteMultiple')->name('candidate.deleteMultiple');

    // SETTINGS Controller
    Route::resource('role', 'Settings\RolesController')->middleware('auth');
    Route::get('role/{role}/permission', 'Settings\RolesController@permission')->middleware('auth');
    Route::post('role/{role}/permission', 'Settings\RolesController@givePermission')->name('give.permission')->middleware('auth');
    
    Route::get('settings/getRoles', 'Settings\RolesController@getRoles');
    Route::get('roles/permission', 'Settings\RolesController@rolePermission');    
    Route::resource('settings/permission', 'Settings\PermissionsController')->middleware('auth');
    Route::get('settings/getPermissions', 'Settings\PermissionsController@getPermissions');
    Route::resource('settings/group', 'Settings\GroupsController');       
    Route::resource('settings/users', 'Settings\UsersController');
});

Route::group(['middleware' => 'auth'], function () { 
   
    Route::resource('import', 'ImportsController');
    Route::get('translations/new', 'TranslationsController@new')->name('translations.new');
    Route::get('translations/add', 'TranslationsController@add')->name('translations.add');
    Route::post('translations/save', 'TranslationsController@saveTranslations')->name('translations.save');
    Route::resource('translations', 'TranslationsController');
    
    Route::get('settings/profile/{user}', 'Settings\ProfilesController@show')->name('user.profile');
    Route::get('settings/profile/{user}/edit', 'Settings\ProfilesController@edit')->name('edit.profile');
    Route::post('settings/profile/{user}', 'Settings\ProfilesController@update')->name('update.profile');

    // Helping Routes
    Route::get('help/users', 'HelpsController@users')->name('help.users');
    Route::get('help/settings', 'HelpsController@settings')->name('help.settings');
    Route::get('help/participants', 'HelpsController@participants')->name('help.participants');    
    Route::get('help/tests', 'HelpsController@tests')->name('help.tests');
    Route::get('help/translation', 'HelpsController@translation')->name('help.translation');
    //  /Help Routes

});

Route::get('skills', function () {
    return ['label' => ['laravel', 'vue', 'php']];
});
