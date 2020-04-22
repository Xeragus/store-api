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

Route::prefix('products')->group(function () {
    Route::get('/', 'ProductsController@index'); // api/products
    Route::post('/create', 'ProductsController@addProduct'); // api/products/create
    Route::get('/get-by-name', 'ProductsController@getByName'); // api/products/get-by-name
    Route::get('/{id}', 'ProductsController@getById'); // api/products/{id}
    Route::delete('/{id}', 'ProductsController@delete'); // api/products/{id}
    Route::get('/{id}/company', 'ProductsController@getCompany'); // api/products/{id}/company
});

Route::post('/orders/add-product', 'OrdersController@addProduct');
Route::get('/orders', 'OrdersController@index');

Route::prefix('companies')->group(function () {
  Route::get('/', 'CompaniesIndexController@index'); // /companies
  Route::post('/create', 'CompaniesCreateController@create')->middleware(\App\Http\Middleware\CheckCompanyCreateData::class); // /companies
  Route::get('/{id}', 'CompaniesIndexController@getCompany'); // /companies/{id}
  Route::get('/{id}/products', 'CompaniesProductsController@getProducts'); // /companies/{id}/products
});

Route::prefix('users')->group(function() {
    Route::get('/', 'UserIndexController@index');
    Route::get('/{id}', 'UserShowController@show');
    Route::post('/create', 'UserCreateController@create');
    Route::delete('/{id}', 'UserDeleteController@delete');
});

Route::prefix('locations')->group(function () {
    Route::get('/','LocationIndexController@index');
    Route::get('/{id}', 'LocationShowController@show');
    Route::delete('/{id}', 'LocationDeleteController@delete');
    Route::post('/create', 'LocationCreateController@create');
});
