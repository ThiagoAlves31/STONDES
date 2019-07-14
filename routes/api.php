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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('Api')->name('api.')->group(function(){
    Route::prefix('products')->group(function(){
        
        Route::get('/','ProductController@index')->name('products_index');
        Route::get('/{id}','ProductController@id')->name('products_id');

        Route::post('/','ProductController@InsertProduct')->name('products_insert');
        Route::put('/{id}','ProductController@UpdateProduct')->name('products_update');
        Route::delete('/{id}','ProductController@DeleteProduct')->name('products_delete');

    });
});

Route::namespace('Api')->name('api.')->group(function(){
        Route::prefix('contacts')->group(function(){
        
        Route::get('/','ContactController@index')->name('contacts_index');
        Route::get('/{id}','ContactController@id')->name('contacts_id');

        Route::post('/','ContactController@InsertContact')->name('contacts_insert');
        Route::put('/{id}','ContactController@UpdateContact')->name('contacts_update');
        Route::delete('/{id}','ContactController@DeleteContact')->name('contacts_delete');

    });
});