<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('projectScreening', 'ProjectController@projectIndex')->name('projectScreening');
    Route::get('get-projects', 'ProjectController@projScrenningShow');
    Route::post('newProject', 'ProjectController@projScrenningSave');
    Route::post('cancelProjet/{id}', 'ProjectController@cancelProject');

    Route::get('projectApproval', 'ProjectController@projectIndex')->name('projectApproval');
    Route::post('rejectProjet/{id}', 'ProjectController@rejectProject');
    Route::post('approveProject', 'ProjectController@approveProject');

    Route::get('buyout', 'BuyoutController@index')->name('buyout');
    Route::post('buyOutProject/{id}', 'ProjectController@buyOutProject');
    Route::post('buyoutType', 'ProjectController@saveBuyoutType');
    Route::get('buyout/view/{id}', 'BuyoutController@view')->name('buyout_view');
    Route::get('saveBuyoutDetails/{id}', 'BuyoutController@view');
    Route::post('updateBuyoutCompany', 'BuyoutController@updateBuyout');
    Route::post('buyout/view/savePayment/{proj_id}/{bo_id}', 'BuyoutController@savePayment');

    Route::get('user', 'UserManagementController@index');
    Route::post('saveUser', 'UserManagementController@save')->name('saveUser');
    Route::post('updateUser/{id}', 'UserManagementController@update');
    Route::post('disableUser/{id}', 'UserManagementController@disable');
    Route::post('activateUser/{id}', 'UserManagementController@enable');
    Route::post('resetPass/{id}', 'UserManagementController@reset');












    // Route::group(['middleware' => 'admin'], function () {
    // });

    // Route::group(['middleware' => 'requestor'], function () {
    // });

    // Route::group(['middleware' => 'approver'], function () {
    // });

    // Route::get('get-projects', ['as'=>'get.data','uses'=>'ProjectScreeningController@show']);

});
