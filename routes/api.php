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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/jobdetails/{id}' , 'HomeController@job_details');
Route::get('/user/{id}' , 'HomeController@userdetails');
Route::post('/contact' , 'HomeController@store_contact');
Route::post('/login' , 'HomeController@login');
Route::post('/logout' , 'HomeController@logout');

Route::post('/customer/register' , 'CustomerController@store_register');
Route::post('/customer/storejob' , 'CustomerController@store_job');
Route::get('/customer/editjob/{id}' , 'CustomerController@edit_job');
Route::put('/customer/updatejob' , 'CustomerController@update_job');
Route::delete('/customer/deletejob/{id}' , 'CustomerController@delete_job');
Route::put('/customer/acceptrequest/{id}' , 'CustomerController@accept_request');
Route::put('/customer/refuserequest/{id}' , 'CustomerController@refuse_request');
Route::get('/customer/myjobs' , 'CustomerController@myjobs');
Route::get('/customer/job/{id}' , 'CustomerController@job');
Route::get('/customer/editprofile' , 'CustomerController@edit_profile');
Route::put('/customer/updateprofile' , 'CustomerController@update_profile');
Route::put('/customer/undorequest/{id}' , 'CustomerController@undo_request');

Route::post('/worker/register' , 'WorkerController@store_register');
Route::post('/worker/requestjob/{id}' , 'WorkerController@request_job');
Route::get('/worker/myrequests' , 'WorkerController@my_requests');
Route::get('/worker/acceptedrequests' , 'WorkerController@accepted_requests');
Route::get('/worker/refusedrequests' , 'WorkerController@refused_requests');
Route::delete('/worker/cancelrequest/{id}' , 'WorkerController@cancel_request');
Route::get('/worker/editprofile' , 'WorkerController@edit_profile');
Route::put('/worker/updateprofile' , 'WorkerController@update_profile');

Route::post('/company/register' , 'CompanyController@store_register');
Route::post('/company/requestjob/{id}' , 'CompanyController@request_job');
Route::get('/company/myrequests' , 'CompanyController@my_requests');
Route::get('/company/acceptedrequests' , 'CompanyController@accepted_requests');
Route::get('/company/refusedrequests' , 'CompanyController@refused_requests');
Route::delete('/company/cancelrequest/{id}' , 'CompanyController@cancel_request');
Route::get('/company/editprofile' , 'CompanyController@edit_profile');
Route::put('/company/updateprofile' , 'CompanyController@update_profile');

Route::get('/index', 'HomeController@index');
