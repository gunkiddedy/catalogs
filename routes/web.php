<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', 'MemberController@index')->middleware('auth', 'member');
Route::get('/dashboard', 'MemberController@index')->middleware('auth', 'member');

Route::get('/product/add', 'ProductController@create')->middleware('auth', 'member');
Route::post('/product/store', 'ProductController@store')->name('product.store')->middleware('auth', 'member');
Route::put('/product/update/{id}', 'ProductController@update')->name('product.update')->middleware('auth', 'member');
Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit')->middleware('auth', 'member');
Route::delete('/product/delete/{id}', 'ProductController@destroy')->name('product.delete')->middleware('auth', 'member');

// showing product catalogs per user
Route::get('/product/list', 'ProductController@list')->name('product.list')->middleware('auth', 'member');


// showing product catalog for guest or public access
Route::get('/product', 'ProductController@index');
Route::get('/product/detail/{id}', 'ProductController@details')->name('product.detail');




