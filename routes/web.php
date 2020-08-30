<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'IndexController@show');

Route::get('/admin', 'Admin\MainController@index');
Route::post('/admin/uploadImage', 'Admin\MainController@uploadImage');
Route::get('/admin/{any}', 'Admin\MainController@index')->where('any', '.*');

Auth::routes();
