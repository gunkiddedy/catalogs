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


// Route::get('sni', 'Api\TkdnSniController@getSNI');


// Route::view('/', 'index');
// =======================================PUBLIC PAGE======================================

Route::view('/', 'products.index');

Route::get('/about', 'PageController@about');
Route::get('/contact', 'PageController@contact');
Route::get('/guest', 'ProductController@index');
Route::get('/products', 'ProductController@index');
Route::get('/products/subcategory/{id}', 'ProductController@findBySubCategory');

// Route::get('/products', function(){
//     dd(\App\Product::with('user')->first());
// });
Route::get('/product/detail/{id}', 'ProductController@details')->name('product.detail');
Route::get('/company/detail/{id}', 'CompanyController@detail')->name('company.detail');
// Route::get('/product/search', 'ProductController@search')->name('product.search');
// Route::get('/product/filter', 'ProductController@filter')->name('product.filter');



// =================================ADMIN =========================================================================
Route::get('/admin', 'AdminController@index')->name('admin.dashboard')->middleware('auth', 'admin');

Route::get('/category', 'CategoryController@index')->name('category.index')->middleware('auth', 'admin');
Route::get('/category/add', 'CategoryController@addCategory')->name('category.add')->middleware('auth', 'admin');
Route::post('/category/store', 'CategoryController@storeCategory')->name('category.store')->middleware('auth', 'admin');
Route::get('/category/edit/{id}', 'CategoryController@editCategory')->name('category.edit')->middleware('auth', 'admin');
Route::patch('/category/update/{id}', 'CategoryController@updateCategory')->name('category.update')->middleware('auth', 'admin');
// Route::delete('/category/delete/{id}', 'CategoryController@destroy')->name('category.delete')->middleware('auth', 'admin');

Route::get('/subcategory', 'CategoryController@index')->name('subcategory.index')->middleware('auth', 'admin');
Route::get('/subcategory/add', 'CategoryController@addSubCategory')->name('subcategory.add')->middleware('auth', 'admin');
Route::post('/subcategory/store', 'CategoryController@storeSubCategory')->name('subcategory.store')->middleware('auth', 'admin');
Route::get('/subcategory/edit/{id}', 'CategoryController@editSubCategory')->name('subcategory.edit')->middleware('auth', 'admin');
Route::patch('/subcategory/update/{id}', 'CategoryController@updateSubCategory')->name('subcategory.update')->middleware('auth', 'admin');
// Route::delete('/subcategory/delete/{id}', 'CategoryController@destroy')->name('subcategory.delete')->middleware('auth', 'admin');

Route::get('/provinsi', 'ProvinsiController@index')->name('provinsi.index')->middleware('auth', 'admin');
Route::get('/provinsi/edit/{id}', 'ProvinsiController@edit')->name('provinsi.edit')->middleware('auth', 'admin');
Route::patch('/provinsi/update/{id}', 'ProvinsiController@update')->name('provinsi.update')->middleware('auth', 'admin');
Route::delete('/provinsi/delete/{id}', 'ProvinsiController@destroy')->name('provinsi.delete')->middleware('auth', 'admin');

Route::get('/kabupaten', 'KabupatenController@index')->name('kabupaten.index')->middleware('auth', 'admin');
Route::get('/kabupaten/edit/{id}', 'KabupatenController@edit')->name('kabupaten.edit')->middleware('auth', 'admin');
Route::patch('/kabupaten/update/{id}', 'KabupatenController@update')->name('kabupaten.update')->middleware('auth', 'admin');
Route::delete('/kabupaten/delete/{id}', 'KabupatenController@destroy')->name('kabupaten.delete')->middleware('auth', 'admin');

Route::get('/kecamatan', 'KecamatanController@index')->name('kecamatan.index')->middleware('auth', 'admin');
Route::get('/kecamatan/edit/{id}', 'KecamatanController@edit')->name('kecamatan.edit')->middleware('auth', 'admin');
Route::patch('/kecamatan/update/{id}', 'KecamatanController@update')->name('kecamatan.update')->middleware('auth', 'admin');
Route::delete('/kecamatan/delete/{id}', 'KecamatanController@destroy')->name('kecamatan.delete')->middleware('auth', 'admin');


Route::get('/about', 'AdminController@about')->name('about.index')->middleware('auth', 'admin');
Route::get('/about/edit/{id}', 'AdminController@editAbout')->name('about.edit')->middleware('auth', 'admin');
Route::patch('/about/update/{id}', 'AdminController@updateAbout')->name('about.update')->middleware('auth', 'admin');

Route::get('/contact', 'AdminController@contact')->name('contact.index')->middleware('auth', 'admin');
Route::get('/contact/edit/{id}', 'AdminController@editContact')->name('contact.edit')->middleware('auth', 'admin');
Route::patch('/contact/update/{id}', 'AdminController@updateContact')->name('contact.update')->middleware('auth', 'admin');


Route::get('/product-require', 'AdminController@productRequire')->name('product.require')->middleware('auth', 'admin');
Route::get('/product-require/detail/{id}', 'AdminController@productRequireDetail')->name('product-require.detail')->middleware('auth', 'admin');
Route::get('/product-require/edit/{id}', 'AdminController@productRequireEdit')->name('product-require.edit')->middleware('auth', 'admin');
Route::patch('/product-require/update/{id}', 'AdminController@productRequireUpdate')->name('product-require.update')->middleware('auth', 'admin');

Route::get('/members', 'AdminController@memberList')->name('member.list')->middleware('auth', 'admin');
Route::get('/users/edit/{id}', 'UserController@edit')->name('user.edit')->middleware('auth', 'admin');
Route::patch('/users/update/{id}', 'UserController@update')->name('user.update')->middleware('auth', 'admin');
Route::delete('/users/delete/{id}', 'UserController@userDestroy')->name('user.delete')->middleware('auth', 'admin');

Route::get('/blacklist', 'UserController@emailBlacklist')->name('blacklist.list')->middleware('auth', 'admin');
Route::delete('/blacklist/delete/{id}', 'UserController@emailDestroy')->name('blacklist.delete')->middleware('auth', 'admin');


// ============================MEMBER PROFILE ===============================================================================
Route::get('/profile/{id}', 'ProfileController@profile')->name('profile.show')->middleware('auth');
Route::get('/profile/edit/{id}', 'ProfileController@editProfile')->name('profile.edit')->middleware('auth');
Route::patch('/profile/update/{id}', 'ProfileController@updateProfile')->name('profile.update')->middleware('auth');
Route::patch('/avatar/update/{id}', 'ProfileController@updateAvatar')->name('avatar.update')->middleware('auth');


// ================================MEMBER=======================================================
Route::get('/member', 'MemberController@index')->name('member.dashboard')->middleware('auth', 'member');


// ===============================Member Product==========================================================
Route::get('/product/add', 'ProductController@create')->middleware('auth', 'member', 'active.user');
Route::post('/product/store', 'ProductController@store')->name('product.store')->middleware('auth', 'member', 'active.user');
Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit')->middleware('auth', 'member', 'active.user');
Route::patch('/product/update/{id}', 'ProductController@update')->name('product.update')->middleware('auth', 'member', 'active.user');
Route::delete('/product/delete/{id}', 'ProductController@destroy')->name('product.delete')->middleware('auth', 'member', 'active.user');


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


