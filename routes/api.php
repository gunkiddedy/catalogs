<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\User as UserResource;
use App\User;
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


Route::get('categories', 'Api\CategoryController@index');
Route::get('subcategories', 'Api\SubCategoryController@index');
Route::get('search', 'Api\SearchController@search');
// Route::get('kabupatens', 'Api\KabupatenController@index');
Route::get('getprovinsis', 'Api\WilayahController@getProvinsi');
Route::get('getkabupatens', 'Api\WilayahController@getKabupaten');
Route::get('products', 'Api\ProductController@index');
Route::get('products/search', 'Api\ProductController@search');

Route::get('products/company/{id}', 'Api\ProductController@companyProducts');
Route::get('products/company/search/{id}', 'Api\ProductController@searchProductCompany');

Route::get('details', 'Api\ProductDetailsController@index');

// test resource
// Route::get('/user/{id}', function ($id) {
//     return new UserResource(User::find($id));
// });

// Route::get('/user', function () {
//     return UserResource::collection(User::all());
// });
