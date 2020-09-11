<?php

use Illuminate\Support\Facades\Route;

Route::get('/artisan', 'ArtisanController@run');
//Фронтенд
Route::get('/', 'IndexController@show');
Route::get('/categories/{id}', 'CategoryController@show');
Route::get('/sub-categories/{id}', 'SubCategoryController@show');
Route::get('/products/search', 'ProductController@search');
Route::get('/products/{id}', 'ProductController@index');

Route::get('/basket', 'BasketController@index');
Route::post('/basket/put', 'BasketController@put');
Route::post('/basket/delete', 'BasketController@delete');

Route::get('/favorite', 'FavoriteController@index');
Route::post('/favorite/put', 'FavoriteController@put');
Route::post('/favorite/clear', 'FavoriteController@clear');

Route::post('/question', 'QuestionController@create');

//Инфо шапка/футер
Route::get('/contacts', 'InfoController@contacts');
Route::get('/about', 'InfoController@about');
Route::get('/delivery', 'InfoController@delivery');
Route::get('/payment', 'InfoController@payment');
Route::get('/requisites', 'InfoController@requisites');
Route::get('/services', 'InfoController@services');
Route::get('/cooperation', 'InfoController@cooperation');

//Админка
Route::get('/admin', 'Admin\MainController@index');
Route::post('/admin/uploadImage', 'Admin\MainController@uploadImage');
Route::get('/admin/{any}', 'Admin\MainController@index')->where('any', '.*');

Auth::routes();
