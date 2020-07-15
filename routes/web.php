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

Route::get('/', 'CatalogoController@index')->name('catalogo');
Route::get('/catalogo/{categoria}', 'CatalogoController@catalogo')->name('catalogo.categoria');

Auth::routes();

Route::get('/home', 'CatalogoController@index')->name('home');
Route::get('/produtos/{produto}', 'ProdutoController@showProduto')->name('produtos.showProduto');
Route::put('/produtos/{produto}/addtocart', 'ProdutoController@addToCart')->name('produtos.addToCart');


Route::post('/produtos/{produto}/addcomment', 'ProdutoController@addcomment')->name('produtos.addcomentario');

Route::get('/comentarios/{comentario}/delete', 'ComentarioController@destroy')->name('comentarios.destroy');

// Carrinho de compras
Route::get('/cart', 'ProdutoController@showcart')->name('produtos.showcart');
Route::post('/cart/update', 'ProdutoController@updatecart' )->name('produtos.updatecart');
Route::get('/cart/checkout', 'EncomendaController@create')->name('encomendas.create');
Route::get('/cart/pay', 'EncomendaController@payment')->name('cart.payment');


/**
 * Administração do site
 *  */ 

// Categorias
Route::get('/admin/categorias', 'CategoriaController@index')->name('admin.categorias.index');
Route::get('/admin/categorias/create', 'CategoriaController@create')->name('admin.categorias.create');
Route::put('/admin/categorias', 'CategoriaController@store')->name('admin.categorias.store');
Route::get('/admin/categorias/{categoria}/delete', 'CategoriaController@delete')->name('admin.categorias.delete');
Route::delete('/admin/categorias/{categoria}/delete', 'CategoriaController@destroy')->name('admin.categorias.destroy');
Route::get('/admin/categorias/{categoria}/edit', 'CategoriaController@edit')->name('admin.categorias.edit');
Route::patch('/admin/categorias/{categoria}/edit', 'CategoriaController@update')->name('admin.categorias.update');

// Produtos
Route::get('/admin/produtos', 'ProdutoController@index')->name('admin.produtos.index');
Route::get('/admin/produtos/create', 'ProdutoController@create')->name('admin.produtos.create');
Route::put('/admin/produtos', 'ProdutoController@store')->name('admin.produtos.store');
Route::get('/admin/produtos/{produto}', 'ProdutoController@show')->name('admin.produtos.show');
Route::get('/admin/produtos/{produto}/delete', 'ProdutoController@delete')->name('admin.produtos.delete');
Route::delete('/admin/produtos/{produto}/delete', 'ProdutoController@destroy')->name('admin.produtos.destroy');
Route::get('/admin/produtos/{produto}/edit', 'ProdutoController@edit')->name('admin.produtos.edit');
Route::patch('/admin/produtos/{produto}/edit', 'ProdutoController@update')->name('admin.produtos.update');

// Encomendas
Route::get('/encomendas', 'EncomendaController@index')->name('encomendas.index');
Route::get('/encomendas/{encomenda}', 'EncomendaController@show')->name('encomendas.show');
Route::get('/encomendas/{encomenda}/processar', 'EncomendaController@processar')->name('encomendas.processar');
Route::get('/encomendas/{encomenda}/destroy', 'EncomendaController@destroy')->name('encomendas.destroy');

// Utilizadores
Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/{user}/delete', 'UsersController@destroy')->name('users.delete');
Route::get('/users/{user}/admin', 'UsersController@admin')->name('users.admin');