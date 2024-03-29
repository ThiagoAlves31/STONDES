<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('products.index');
});

Route::get('/products/{id}', function ($id) {
	$product = App\Product::where('product_id',$id)->first();
    return view('products.update',compact('product'));
});

Route::get('/productscreate', function () {
    return view('products.create');
});

Route::get('/contacts', function () {
    return view('contacts.index');
});

Route::get('/contactscreate', function () {
    return view('contacts.create');
});

Route::get('/contacts/{id}', function ($id) {
	$contact = App\Contacts::where('contact_id',$id)->first();
    return view('contacts.update',compact('contact'));
});

Route::get('/productlent/{id}', function ($id) {
	$lentProduct = App\Product::where('product_id',$id)->first();
	//$contact = App\Contact::where('contact_id',$id)->first();
    return view('products.lent',compact('lentProduct'));
});

Route::get('/lents', function () {
    return view('lents.index');
});

