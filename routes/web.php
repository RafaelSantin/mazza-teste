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

Route::get('/ind', function () {
    return view('index');
});

Route::get('/agendamento', function () {	
    return view('agendamento');
});


Route::get('/listarAgendamentos', ['as' => 'listarAgendamentos', 'uses'=> 'scheduleController@openPage']);

Route::get('/listarMedicos', function () {
    return view('doctor.doctorList');
});

Route::get('/listarUsuarios', function () {
    return view('doctor.userList');
});

Route::post('/insertDoctor', ['as' => 'storeDoctors', 'uses'=> 'DoctorController@store']);
Route::post('/updateDoctor', ['as' => 'updateDoctors', 'uses'=> 'DoctorController@update']);
Route::post('/deleteDoctor', ['as' => 'deleteDoctors', 'uses'=> 'DoctorController@destroy']);
Route::get('/listDoctors', ['as' => 'listDoctors', 'uses'=> 'DoctorController@index']);

Route::get('/listPatients', ['as' => 'listPatients', 'uses'=> 'PatientController@index']);
Route::post('/insertPatient', ['as' => 'storePatient', 'uses'=> 'PatientController@store']);
Route::post('/updatePatient', ['as' => 'updatePatient', 'uses'=> 'PatientController@update']);
Route::post('/deletePatient', ['as' => 'deletePatient', 'uses'=> 'PatientController@destroy']);

Route::get('/listUsers', ['as' => 'listUsers', 'uses'=> 'UserController@index']);
Route::post('/insertUser', ['as' => 'insertUser', 'uses'=> 'UserController@store']);
Route::post('/updateUser', ['as' => 'updateUser', 'uses'=> 'UserController@update']);
Route::post('/deleteUser', ['as' => 'deleteUser', 'uses'=> 'UserController@destroy']);

Route::get('/listSchedules', ['as' => 'listSchedules', 'uses'=> 'ScheduleController@index']);
Route::post('/insertSchedule', ['as' => 'insertSchedule', 'uses'=> 'ScheduleController@store']);
Route::post('/updateSchedule', ['as' => 'updateSchedule', 'uses'=> 'ScheduleController@update']);
Route::post('/deleteSchedule', ['as' => 'deleteSchedule', 'uses'=> 'ScheduleController@destroy']);