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

Route::get('/', 'ProductController@index');



// =================================ADMIN AREA ======================================================
Route::get('/admin', 'AdminController@index')->middleware('auth', 'admin');

// =================================ENDADMIN AREA ======================================================

Route::get('/profile/{id}', 'ProfileController@profile')->name('profile.show')->middleware('auth');
Route::get('/profile/edit/{id}', 'ProfileController@editProfile')->name('profile.edit')->middleware('auth');
Route::patch('/profile/update/{id}', 'ProfileController@updateProfile')->name('profile.update')->middleware('auth');
Route::patch('/avatar/update/{id}', 'ProfileController@updateAvatar')->name('avatar.update')->middleware('auth');

// ================================MEMBER AREA========================================================
Route::get('/member', 'MemberController@index')->middleware('auth', 'member');
// =============================end member area-----------------========================================

// ===============================Product Area==========================================================
Route::get('/product/add', 'ProductController@create')->middleware('auth', 'member');
Route::post('/product/store', 'ProductController@store')->name('product.store')->middleware('auth', 'member');
Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit')->middleware('auth', 'member');
Route::put('/product/update/{id}', 'ProductController@update')->name('product.update')->middleware('auth', 'member');
Route::delete('/product/delete/{id}', 'ProductController@destroy')->name('product.delete')->middleware('auth', 'member');
// ===============================end Product Area======================================================

// showing product catalog for guest or public access
Route::get('/guest', 'ProductController@index');
Route::get('/product', 'ProductController@index');
Route::get('/product/detail/{id}', 'ProductController@details')->name('product.detail');




