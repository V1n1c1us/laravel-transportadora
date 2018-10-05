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

$this->get('/','HomeController@index')->name('home');

$this->get('produto', 'ProdutoController@index')->name('produto.index');
$this->post('produto.store', 'ProdutoController@store')->name('produto.store');

$this->get('fornecedor', 'FornecedorController@index')->name('fornecedor.index');
$this->post('store', 'FornecedorController@store')->name('fornecedor.store');
