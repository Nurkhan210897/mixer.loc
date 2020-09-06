<?php

use Illuminate\Support\Facades\Route;

//Фронтенд
Route::get('/', 'IndexController@show');
Route::get('/sub-categories/{id}', 'SubCategoryController@show');
Route::get('/products/search', 'ProductController@search');
Route::get('/products/{id}', 'ProductController@index');

Route::get('/basket', 'BasketController@index');
Route::post('/basket/put', 'BasketController@put');

//Админка
Route::get('/admin', 'Admin\MainController@index');
Route::post('/admin/uploadImage', 'Admin\MainController@uploadImage');
Route::get('/admin/{any}', 'Admin\MainController@index')->where('any', '.*');

Auth::routes();
