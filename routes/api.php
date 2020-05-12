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
    Route::post('/create', 'ProductsController@create'); // api/products/create
    Route::get('/{id}', 'ProductsController@show'); // api/products/{id}
    Route::delete('/{id}', 'ProductsController@delete'); // api/products/{id}
    Route::get('/{id}/company', 'ProductsController@getCompany'); // api/products/{id}/company
});

Route::prefix('orders')->group(function (){
    Route::post('/add-product', 'OrdersController@addProduct');
    Route::post('/remove-product', 'OrdersController@removeProduct');
    Route::get('/', 'OrdersController@index');
    Route::post('/add-product-to-order', 'AddProductToOrderController@addProduct');
});

Route::prefix('companies')->group(function () {
    Route::get('/', 'CompaniesIndexController@index');
    Route::post('/create', 'CompaniesCreateController@create')
        ->middleware(\App\Http\Middleware\CheckCompanyCreateData::class);

  Route::group(['middleware' => 'company.ownership'], function (){
      Route::get('/{id}', 'CompaniesIndexController@getCompany');
      Route::get('/{id}/products', 'CompaniesProductsController@getProducts');
      Route::delete('/{id}', 'CompaniesDeleteController@delete');
      Route::post('/update/{id}', 'CompaniesUpdateController@update');
  });
});

Route::prefix('users')->group(function() {
    Route::get('/', 'UserIndexController@index');
    Route::get('/{id}', 'UserShowController@show');
    Route::post('/create', 'UserCreateController@create');
    Route::delete('/{id}', 'UserDeleteController@delete');
});

Route::prefix('locations')->group(function () {
    Route::get('/','LocationController@index');
    Route::get('/{id}', 'LocationController@show');
    Route::delete('/{id}', 'LocationDeleteController@delete');
    Route::post('/create', 'LocationController@create');
});

Route::prefix('categories')->group(function (){
    Route::post('/create', 'CategoriesController@create');
    Route::delete('/delete', 'CategoriesController@delete');
    Route::get('/', 'CategoriesController@index');
    Route::get('/{id}', 'CategoriesController@show');
});

Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
