<?php

use Illuminate\Support\Facades\Route;

//Фронтенд
Route::get('/', 'IndexController@show');
Route::get('/sub-categories/{id}', 'SubCategoryController@show');
Route::get('/products/{id}', 'ProductController@show');

//front
Route::get('/basket',function(){
 return view('basket');
});
//

//Админка
Route::get('/admin', 'Admin\MainController@index');
Route::post('/admin/uploadImage', 'Admin\MainController@uploadImage');
Route::get('/admin/{any}', 'Admin\MainController@index')->where('any', '.*');

Auth::routes();
