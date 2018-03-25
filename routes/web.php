<?php
use App\Job;
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
Route::group(['middleware'=> 'NoCache' ] ,function(){


Route::get('/jobdetails/{id}' , 'HomeController@job_details');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/user/{id}' , 'HomeController@userdetails');
Route::get('/contact' , 'HomeController@contact');
Route::post('/contact' , 'HomeController@store_contact');
Route::get('/about' , 'HomeController@about');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/customer/register' , 'CustomerController@register');
Route::post('/customer/register' , 'CustomerController@store_register');
Route::get('/customer/addjob' , 'CustomerController@add_job');
Route::post('/customer/storejob' , 'CustomerController@store_job');
Route::get('/customer/editjob/{id}' , 'CustomerController@edit_job');
Route::post('/customer/updatejob' , 'CustomerController@update_job');
Route::post('/customer/deletejob/{id}' , 'CustomerController@delete_job');
Route::get('/customer/acceptrequest/{id}' , 'CustomerController@accept_request');
Route::post('/customer/refuserequest/{id}' , 'CustomerController@refuse_request');
Route::get('/customer/myjobs' , 'CustomerController@myjobs');
Route::get('/customer/job/{id}' , 'CustomerController@job');
Route::get('/customer/editprofile' , 'CustomerController@edit_profile');
Route::post('/customer/updateprofile' , 'CustomerController@update_profile');
Route::get('/customer/undorequest/{id}' , 'CustomerController@undo_request');

Route::get('/worker/register' , 'WorkerController@register');
Route::post('/worker/register' , 'WorkerController@store_register');
Route::post('/worker/requestjob/{id}' , 'WorkerController@request_job');
Route::get('/worker/myrequests' , 'WorkerController@my_requests');
Route::get('/worker/acceptedrequests' , 'WorkerController@accepted_requests');
Route::get('/worker/refusedrequests' , 'WorkerController@refused_requests');
Route::get('/worker/cancelrequest/{id}' , 'WorkerController@cancel_request');
Route::get('/worker/editprofile' , 'WorkerController@edit_profile');
Route::post('/worker/updateprofile' , 'WorkerController@update_profile');

Route::get('/company/register' , 'CompanyController@register');
Route::post('/company/register' , 'CompanyController@store_register');
Route::post('/company/requestjob/{id}' , 'CompanyController@request_job');
Route::get('/company/myrequests' , 'CompanyController@my_requests');
Route::get('/company/acceptedrequests' , 'CompanyController@accepted_requests');
Route::get('/company/refusedrequests' , 'CompanyController@refused_requests');
Route::get('/company/cancelrequest/{id}' , 'CompanyController@cancel_request');
Route::get('/company/editprofile' , 'CompanyController@edit_profile');
Route::post('/company/updateprofile' , 'CompanyController@update_profile');

Route::get('/admin/dashboard' , 'AdminController@index');
Route::get('/admin/jobstoapprove' , 'AdminController@approve_jobs');
Route::post('/admin/approvejob/{id}' , 'AdminController@approve_job');
Route::post('/admin/disapprovejob/{id}' , 'AdminController@disapprove_job');
Route::get('/admin/disapprovedjobs' , 'AdminController@disapproved_jobs');
Route::get('/admin/approvedjobs' , 'AdminController@approved_jobs');
Route::post('/admin/deletejob/{id}' , 'AdminController@delete_job');
Route::get('/admin/customers' , 'AdminController@customers');
Route::get('/admin/freeworkers' , 'AdminController@workers');
Route::get('admin/companies' , 'AdminController@companies');
Route::get('/admin/requests' , 'AdminController@requests');
Route::get('/admin/acceptedrequests' , 'AdminController@accepted_requests');
Route::get('admin/editprofile' , 'AdminController@edit_profile');
Route::post('admin/updateprofile' , 'AdminController@update_profile');
Route::get('/admin/changepassword' , 'AdminController@change_password');
Route::post('/admin/changepassword' , 'AdminController@store_password');
Route::get('/admin/jobdetails/{id}' , 'AdminController@job_details');
Route::get('/admin/contacts' , 'AdminController@contacts');
Route::post('/admin/deletecontact/{id}' , 'AdminController@delete_contact');

});