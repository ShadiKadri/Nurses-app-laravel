<?php

use Illuminate\Support\Facades\Route;

// Home Page Routes
Route::get('/', 'FrontEndController@index');
Route::get('/new-appointment/{nurseId}/{date}', 'FrontEndController@show')->name('create.appointment');

Route::get('/dashboard', 'DashBoardController@index');

Route::get('/home', 'HomeController@index');

Auth::routes();

// Patient Routes
Route::group(['middleware' => ['auth', 'patient']], function () {
    // Profile Routes
    Route::get('/user-profile', 'ProfileController@index')->name('profile');
    Route::post('/user-profile', 'ProfileController@store')->name('profile.store');
    Route::post('/profile-pic', 'ProfileController@profilePic')->name('profile.pic');

    Route::post('/book/appointment', 'FrontEndController@store')->name('book.appointment');
    Route::get('/my-booking', 'FrontEndController@myBookings')->name('my.booking');
    Route::get('/my-prescription', 'FrontEndController@myPrescription')->name('my.prescription');
});
// Admin Routes
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('nurse', 'NurseController');
    Route::get('/status/update/{id}', 'PatientListController@toggleStatus')->name('update.status');
    Route::resource('/caring-types', 'CaringTypeController');
    Route::resource('/patient', 'PatientsController');
    Route::resource('/caring', 'CaringsController');
});
// Nurse Routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/patients', 'PatientListController@index')->name('patients');
    Route::get('/all-patients', 'PatientListController@allTimeAppointment')->name('all.appointments');
});
