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

Route::get('/produto/create',['as' => 'produto.create','uses' => 'ProdutoController@index']);
Route::get('/produto/edit/{id}',['as' => 'produto.edit','uses' => 'ProdutoController@edit']);
Route::get('/produto/view/{id}',['as' => 'produto.view','uses' => 'ProdutoController@view']);
Route::post('/produto/store',['as' => 'produto.store','uses' => 'ProdutoController@store']);
Route::post('/produto/update',['as' => 'produto.update','uses' => 'ProdutoController@update']);
Route::get('/produto/delete/{id}', ['as' => 'produto.delete','uses'=>'ProdutoController@delete']);


Route::get('/fornecedor/create',['as' => 'fornecedor.create','uses' => 'FornecedorController@index']);


//$this->get('produto', 'ProdutoController@index')->name('produto.index');
$this->get('produto/info/{id}', 'ProdutoController@getInfo');
$this->post('produto.store', 'ProdutoController@store')->name('produto.store');
//Route::get('produto/delete/{id}', 'ProdutoController@delete');
//$this->get('produto/edit/{id}', 'ProdutoController@edit');
$this->post('produto/update/{id}', 'ProdutoController@update')->name('produto.update');

//$this->get('fornecedor', 'FornecedorController@index')->name('fornecedor.index');
$this->post('store', 'FornecedorController@store')->name('fornecedor.store');
