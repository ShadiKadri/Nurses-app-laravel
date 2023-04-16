<?php

use Illuminate\Support\Facades\Route;

// Home Page Routes
Route::get('/', 'FrontEndController@index');

Route::get('/dashboard', 'DashBoardController@index');

Route::get('/home', 'HomeController@index');

Auth::routes();

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
