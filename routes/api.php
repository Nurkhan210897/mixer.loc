<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/categories', 'Admin\CategoryController');
Route::apiResource('/subCategories', 'Admin\SubCategoryController');

Route::apiResource('/simple', 'Admin\SimpleController');
Route::apiResource('/directory', 'Admin\DirectoryController');
Route::apiResource('/products', 'Admin\ProductController');
