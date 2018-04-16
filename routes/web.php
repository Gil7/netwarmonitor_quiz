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
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//CONTACTS 
Route::get('allcontacts', 'ContactsController@getMyContacts');
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

//ABOUT
Route::get('about-me', 'AboutController@index');
//USERS
Route::get('profile', 'UsersController@profile');
Route::get('getMyProfile', 'UsersController@getMyProfile');
Route::put('users/{id}', 'UsersController@update');

