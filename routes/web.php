<?php
use App\Routes\Route;
use App\Controllers\HomeController;
use App\Controllers\ClientController;

Route::get('/', 'ClientController@index');
Route::get('/', 'ClientController@login');
Route::get('/client/create', 'ClientController@create');
Route::get('/client/login', 'ClientController@login');
Route::post('/client/create', 'ClientController@store');
Route::post('/client/login', 'ClientController@user');
Route::get('/client/order', 'ClientController@order');
Route::post('/client/order', 'ClientController@basket');
Route::get('/client/show', 'ClientController@show');
Route::post('/client/show', 'ClientController@show');

Route::dispatch();