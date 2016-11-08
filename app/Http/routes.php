<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use \App\Models\Note;

Route::post('/pdf', 'pdfGenerator@generate');


Route::get('/', function () {
    return File::get(public_path().'/index.html');
    //return view('welcome');
});

Route::get('/notes', function () {
    $notes = Note::lists('id');
    return compact('notes');
});

Route::get('/emails', function() {
    $emails = \App\Models\User::lists('email');
    return compact('emails');
});

Route::resource('/evaluer', 'EnqueteSatisfaction');

