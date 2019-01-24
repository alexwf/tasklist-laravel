<?php

Route::get('/', 'TaskController@index');
Route::post('/task', 'TaskController@store');
Route::delete('/task/{task}', 'TaskController@destroy');
Route::get('/edit/{task}', 'TaskController@edit');
Route::patch('/update/{task}', 'TaskController@update');
Route::post('/changeStatus/{task}', 'TaskController@changeStatus');
