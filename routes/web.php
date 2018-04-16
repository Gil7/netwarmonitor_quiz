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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



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


