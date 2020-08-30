<?php

use Illuminate\Support\Facades\Route;

//Фронтенд
Route::get('/', 'IndexController@show');
Route::get('/subCategories', 'SubCategoryController@show');
Route::get('/products', 'ProductController@show');

//Админка
Route::get('/admin', 'Admin\MainController@index');
Route::post('/admin/uploadImage', 'Admin\MainController@uploadImage');
Route::get('/admin/{any}', 'Admin\MainController@index')->where('any', '.*');

Auth::routes();
