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




Auth::routes();

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
Route::get('/' , 'HomeController@home');
});