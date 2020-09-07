<?php

use Illuminate\Support\Facades\Route;

Route::get('/artisan', 'ArtisanController@run');
//Фронтенд
Route::get('/', 'IndexController@show');
Route::get('/sub-categories/{id}', 'SubCategoryController@show');
Route::get('/products/search', 'ProductController@search');
Route::get('/products/{id}', 'ProductController@index');

Route::get('/basket', 'BasketController@index');
Route::post('/basket/put', 'BasketController@put');
Route::get('/collection', function(){
 return view('collection');
});
Route::get('/about', function(){
 return view('about');
});
Route::get('/contacts', function(){
 return view('collection');
});
Route::get('/servis', function(){
 return view('servis');
});
Route::get('/rekvizit', function(){
 return view('rekvizit');
});
Route::get('/delivery', function(){
 return view('delivery');
});
Route::get('/payment', function(){
 return view('payment');
});
//Админка
Route::get('/admin', 'Admin\MainController@index');
Route::post('/admin/uploadImage', 'Admin\MainController@uploadImage');
Route::get('/admin/{any}', 'Admin\MainController@index')->where('any', '.*');

Auth::routes();
