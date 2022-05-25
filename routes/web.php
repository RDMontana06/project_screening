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

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/', 'HomeController@index');
        Route::get('/home', 'HomeController@index')->name('index');
        // Route::get('projectScreening', 'ProjectScreeningController@index')->name('projectScreening');
    });
    Route::group(['middleware' => 'requestor'], function () {

        // Project Screening
        Route::get('projectScreening', 'ProjectScreeningController@index')->name('projectScreening');
        Route::get('get-projects', 'ProjectScreeningController@show');
        Route::post('newProject', 'ProjectScreeningController@saveProject');
        Route::post('cancelProjet/{id}', 'ProjectScreeningController@canProject');
        Route::post('viewProjet/{id}', 'ProjectScreeningController@viewProject');
    });

    Route::group(['middleware' => 'approver'], function () {
        // Project Approval
        Route::get('projectApproval', 'ProjectApprovalController@index')->name('projectApproval');
        Route::post('rejectProjet/{id}', 'ProjectApprovalController@rejProject');
        Route::post('approveProjet/{id}', 'ProjectApprovalController@approveProject');
    });

    // Route::get('get-projects', ['as'=>'get.data','uses'=>'ProjectScreeningController@show']);

});
