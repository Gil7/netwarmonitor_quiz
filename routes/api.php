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

//CONTACTS 
Route::get('allcontacts', 'ContactsController@all_contacts');
Route::resource('contacts', 'ContactsController');
//ABOUT
Route::post('send-mail','AboutController@sendMail');
//APOINTMENTS
Route::get('allappointments', 'AppointmentsController@allappointments');
Route::get('appointments/contact/{contact_id}/', 'AppointmentsController@contactAppointments');
Route::get('appointments_range/{from}/{to}/', 'AppointmentsController@appointmentsRange');
Route::get('appointments/averages', 'AppointmentsController@averages');
Route::resource('appointments', 'AppointmentsController');

//STATES
Route::resource('states', 'StatesController');

