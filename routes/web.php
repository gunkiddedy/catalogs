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

Route::get('/', 'PageController@product');
Route::get('/about', 'PageController@about');
Route::get('/contact', 'PageController@contact');
// showing product catalog for guest or public access
Route::get('/guest', 'ProductController@index');
Route::get('/product', 'ProductController@index');
Route::get('/product/detail/{id}', 'ProductController@details')->name('product.detail');

Route::view('index1', 'products.index1');

// =================================ADMIN AREA ======================================================
Route::get('/admin', 'AdminController@index')->name('admin.dashboard')->middleware('auth', 'admin');

Route::get('/admin/about', 'AdminController@about')->name('about.index')->middleware('auth', 'admin');
Route::get('/about/edit/{id}', 'AdminController@editAbout')->name('about.edit')->middleware('auth', 'admin');
Route::patch('/about/update/{id}', 'AdminController@updateAbout')->name('about.update')->middleware('auth', 'admin');

Route::get('/admin/contact', 'AdminController@contact')->name('contact.index')->middleware('auth', 'admin');
Route::get('/contact/edit/{id}', 'AdminController@editContact')->name('contact.edit')->middleware('auth', 'admin');
Route::patch('/contact/update/{id}', 'AdminController@updateContact')->name('contact.update')->middleware('auth', 'admin');

Route::get('/members', 'AdminController@memberList')->name('member.list')->middleware('auth', 'admin');
// =================================END ADMIN AREA ======================================================


// ============================PROFILE AREA=====================================
Route::get('/profile/{id}', 'ProfileController@profile')->name('profile.show')->middleware('auth');
Route::get('/profile/edit/{id}', 'ProfileController@editProfile')->name('profile.edit')->middleware('auth');
Route::patch('/profile/update/{id}', 'ProfileController@updateProfile')->name('profile.update')->middleware('auth');
Route::patch('/avatar/update/{id}', 'ProfileController@updateAvatar')->name('avatar.update')->middleware('auth');
//=================END PROFILE AREA-================================================ 


// ================================MEMBER AREA========================================================
Route::get('/member', 'MemberController@index')->name('member.dashboard')->middleware('auth', 'member');
// =============================end member area-----------------========================================

// ===============================Product Area==========================================================
Route::get('/product/add', 'ProductController@create')->middleware('auth', 'member');
Route::post('/product/store', 'ProductController@store')->name('product.store')->middleware('auth', 'member');
Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit')->middleware('auth', 'member');
Route::patch('/product/update/{id}', 'ProductController@update')->name('product.update')->middleware('auth', 'member');
Route::delete('/product/delete/{id}', 'ProductController@destroy')->name('product.delete')->middleware('auth', 'member');
// ===============================end Product Area======================================================





