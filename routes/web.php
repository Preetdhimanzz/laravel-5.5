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

Route::any('/', 'UserAuthController@login');
Route::any('login-user', 'UserAuthController@login');
Route::any('categories', 'ProductController@categories');

Route::get('/submit', function () {
    return view('submit');
});
Route::post('/submit', function (Request $request) {

});

Route::resource('products','ProductController');
Route::get('create','ProductController@create');
Route::any('product-edit','ProductController@edit');
Route::view('admin', 'home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
