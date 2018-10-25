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

Route::get('/',['as' => 'home','uses' => 'HomeController@index']);

/*
*   PRODUTO ROUTE
*/
Route::group(['prefix' => 'produto'], function() {
    //
    Route::get('/create',['as' => 'produto.create','uses' => 'ProdutoController@index']);
    Route::get('/edit/{id}',['as' => 'produto.edit','uses' => 'ProdutoController@edit']);
    Route::get('/view/{id}',['as' => 'produto.view','uses' => 'ProdutoController@view']);

    Route::post('/store',['as' => 'produto.store','uses' => 'ProdutoController@store']);
    Route::post('/update/{id}',['as' => 'produto.update','uses' => 'ProdutoController@update']);
    Route::get('/delete/{id}', ['as' => 'produto.delete','uses'=>'ProdutoController@delete']);
});
/*
*   FORNECEDOR ROUTE
*/
Route::group(['prefix' => 'fornecedor'], function() {
    //
    Route::get('/create',['as' => 'fornecedor.index','uses' => 'FornecedorController@index']);
    Route::post('/store',['as' => 'fornecedor.store','uses' => 'FornecedorController@store']);
});

