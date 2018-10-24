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
*   FORNECEDOR ROTAS
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
*   FORNECEDOR ROTAS
*/

Route::group(['prefix' => 'fornecedor'], function() {
    //
    Route::get('/create',['as' => 'fornecedor.index','uses' => 'FornecedorController@index']);
    Route::post('/store',['as' => 'fornecedor.store','uses' => 'FornecedorController@store']);
});




//$this->get('produto', 'ProdutoController@index')->name('produto.index');
//$this->get('produto/info/{id}', 'ProdutoController@getInfo');
//$this->post('produto.store', 'ProdutoController@store')->name('produto.store');
//Route::get('produto/delete/{id}', 'ProdutoController@delete');
//$this->get('produto/edit/{id}', 'ProdutoController@edit');
///$this->post('produto/update/{id}', 'ProdutoController@update')->name('produto.update');

//$this->get('fornecedor', 'FornecedorController@index')->name('fornecedor.index');
//$this->post('store', 'FornecedorController@store')->name('fornecedor.store');
