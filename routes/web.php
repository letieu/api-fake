<?php

use Illuminate\Support\Facades\Route;



Route::get('/','ApiController@index')->name('index')->middleware('auth');

Route::resource('api','ApiController')->middleware('auth');


Route::get('/login',"LoginController@login")->name('login.form');
Route::get('/login/git','LoginController@githubLogin')->name('login.github');
Route::get('/login/github', "LoginController@githubCallback")->name('login.gitCallbaclk');
Route::get('/logout',"LoginController@logout")->name('logout');

Route::any('/{user}/{any}','ApiController@go')->name('entry')->where('any', '.*');;


