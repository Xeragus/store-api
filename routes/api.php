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
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/', 'ProductsIndexController@index'); // api/products
        Route::post('/create', 'ProductsController@create'); // api/products/create
        Route::get('/get-by-name', 'ProductsController@getByName'); // api/products/get-by-name
        Route::get('/{id}', 'ProductsController@getById'); // api/products/{id}
        Route::get('/{id}/company', 'ProductsController@company'); // api/products/{id}/company

        Route::group(['middleware' => 'product.ownership'], function() {
            Route::delete('/{id}', 'ProductsController@delete'); // api/products/{id}
            Route::post('/{id}', 'ProductUpdateController@update');
        });
    });
});

Route::prefix('orders')->group(function (){
    Route::post('/add-product', 'OrdersController@addProduct');
    Route::post('/remove-product', 'OrdersController@removeProduct');
    Route::get('/', 'OrdersController@index');
});

Route::prefix('companies')->group(function () {
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/', 'CompaniesIndexController@index'); // /companies
        Route::post('/create', 'CompaniesCreateController@create')
            ->middleware(\App\Http\Middleware\CheckCompanyCreateData::class); // /companies

        Route::group(['middleware' => 'company.ownership'], function() {
            Route::get('/{id}', 'CompaniesIndexController@getCompany'); // /companies/{id}
            Route::get('/{id}/products', 'CompaniesProductsController@getProducts'); // /companies/{id}/products
            Route::post('/{id}', 'CompaniesUpdateController@update');
            Route::delete('/{id}', 'CompaniesDeleteController@delete');
        });
    });
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

Route::prefix('categories')->group(function (){
//    Route::get('/', 'CategoriesIndexController@index');
//    Route::get('/{id}', 'CategoriesShowController@show');
//    Route::post('/create', 'CategoriesCreateController@create');
//    Route::delete('/{id}', 'CategoriesDeleteController@delete');

    Route::post('/create-with-command', 'CategoriesController@createWithCommand');
    Route::post('/create-with-factory', 'CategoriesController@createWithFactory');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
