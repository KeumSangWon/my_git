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

Route::resource("votes", "VotesController");
Route::resource('lastVotes', "Last_votesController")->only(['index', 'show']);

Route::get("myIndex", "Last_votesController@myIndex")->name("myIndex");
Route::post('voting', "VotesController@voting")->name('voting');
Route::get('endVote', "VotesController@endVote")->name('endVote');
Route::get('delete', "VotesController@delete")->name('delete');
Route::post('data', "Last_votesController@data")->name('data');

Route::get('test',function(){
  return view('layouts.index');
});
