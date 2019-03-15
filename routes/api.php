<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('category', 'Category\CategoryController');
//rutas anidada
Route::resource('category.news', 'Category\CategoryController');

Route::resource('album', 'Album\AlbumController');
Route::resource('album.image', 'Album\AlbumController');

Route::resource('image', 'Image\ImageController');
Route::resource('news', 'News\NewsController');


