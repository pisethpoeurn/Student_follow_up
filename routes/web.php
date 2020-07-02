<?php

use Illuminate\Support\Facades\Route;

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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('students', 'StudentController');
Route::get('showComment/{id}','CommentController@index')->name('showComment');
Route::post('addComment/{id}','CommentController@store')->name('addComment');
Route::put('editComments/{id}','CommentController@update')->name('editComments');
Route::get('deleteComments/{id}','CommentController@destroy')->name('deleteComments');
Route::get('followup/{id}','StudentController@updateActiveFollowup')->name('followup');

