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
Route::get('/guest', 'ProductController@index');
Route::get('/products', 'ProductController@index');
Route::get('/product/detail/{id}', 'ProductController@details')->name('product.detail');


// =======================================COMPANY PROFILE======================================
Route::get('/company/detail/{id}', 'CompanyController@detail')->name('company.detail');


// =================================ADMIN =========================================================================
Route::get('/admin', 'AdminController@index')->name('admin.dashboard')->middleware('auth', 'admin');

Route::get('/admin/about', 'AdminController@about')->name('about.index')->middleware('auth', 'admin');
Route::get('/about/edit/{id}', 'AdminController@editAbout')->name('about.edit')->middleware('auth', 'admin');
Route::patch('/about/update/{id}', 'AdminController@updateAbout')->name('about.update')->middleware('auth', 'admin');

Route::get('/admin/contact', 'AdminController@contact')->name('contact.index')->middleware('auth', 'admin');
Route::get('/contact/edit/{id}', 'AdminController@editContact')->name('contact.edit')->middleware('auth', 'admin');
Route::patch('/contact/update/{id}', 'AdminController@updateContact')->name('contact.update')->middleware('auth', 'admin');

Route::get('/members', 'AdminController@memberList')->name('member.list')->middleware('auth', 'admin');


// ============================MEMBER PROFILE ===============================================================================
Route::get('/profile/{id}', 'ProfileController@profile')->name('profile.show')->middleware('auth');
Route::get('/profile/edit/{id}', 'ProfileController@editProfile')->name('profile.edit')->middleware('auth');
Route::patch('/profile/update/{id}', 'ProfileController@updateProfile')->name('profile.update')->middleware('auth');
Route::patch('/avatar/update/{id}', 'ProfileController@updateAvatar')->name('avatar.update')->middleware('auth');


// ================================MEMBER=======================================================
Route::get('/member', 'MemberController@index')->name('member.dashboard')->middleware('auth', 'member');


// ===============================Member Product==========================================================
Route::get('/product/add', 'ProductController@create')->middleware('auth', 'member');
Route::post('/product/store', 'ProductController@store')->name('product.store')->middleware('auth', 'member');
Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit')->middleware('auth', 'member');
Route::patch('/product/update/{id}', 'ProductController@update')->name('product.update')->middleware('auth', 'member');
Route::delete('/product/delete/{id}', 'ProductController@destroy')->name('product.delete')->middleware('auth', 'member');


// Route::get('product/{product}/user/{user}', function ($productId, $userId) {
//     return App\Product::where('id', '=', $productId)
//         ->orWhere('user_id', '=', $userId)
//         ->get();
// });

// Route::get('api/products/{products:name}', function (App\Product $products) {
//     return $products;
// });


// Route::get('users/{id}', function ($id) {
//     return App\User::find($id)->name;
// });

// ==================ELOQUENT TESTING=========================

// Route::get('user_in_provinsi', function () {
//     $users = App\Provinsi::find(1)->users;
//     dd($users);
// });
// Route::get('user_in_kab', function () {
//     $users = App\Kabupaten::find(1)->users;
//     // select * from `users` where `users`.`user_id` = 1 and `users`.`user_id`
//     dd($users);
// });
// Route::get('user_in_kec', function () {
//     $users = App\Kecamatan::find(1)->users;
//     // select * from `users` where `users`.`user_id` = 1 and `users`.`user_id`
//     dd($users);
// });

// Route::get('kecamatan_have_kab', function () {
//     $kecamatans = App\Kabupaten::find(2)->kecamatans;
//     dd($kecamatans);
// });
// Route::get('kab_have_kec', function () {
//     $kabupaten = App\Kecamatan::find(1)->kabupaten;
//     dd($kabupaten);
// });

// Route::get('images_product/{id}', function ($id) {
//     $images = App\Product::find($id)->images;
//     dd($images);
// });

// Route::get('productnya/{id}', function ($id) {
//     $product = App\ProductImage::find($id)->product;
//     dd($product);
// });


