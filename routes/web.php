<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\LojaController;
use App\Http\Controllers\ComprasController;


Route::group(['prefix'=>'marca'], function(){
    Route::get('/', [MarcaController::class, 'index']);
    Route::get('/novo', [MarcaController::class, 'inserir']);
    Route::post('/novo', [MarcaController::class, 'salvar_novo']);
    Route::get('/excluir/{id}', [MarcaController::class, 'excluir']);
    Route::get('/update/{id}', [MarcaController::class, 'alterar']);
    Route::post('/update', [MarcaController::class, 'salvar_update']);

});

Route::group(['prefix'=>'categoria'], function(){
    Route::get('/', [CategoriaController::class, 'index']);
    Route::get('/novo', [CategoriaController::class, 'inserir']);
    Route::post('/novo', [CategoriaController::class, 'salvar_novo']);
    Route::get('/excluir/{id}', [CategoriaController::class, 'excluir']);
    Route::get('/update/{id}', [CategoriaController::class, 'alterar']);
    Route::post('/update', [CategoriaController::class, 'salvar_update']);

});

Route::group(['prefix'=>'cor'], function(){
    Route::get('/', [CorController::class, 'index']);
    Route::get('/novo', [CorController::class, 'inserir']);
    Route::post('/novo', [CorController::class, 'salvar_novo']);
    Route::get('/excluir/{id}', [CorController::class, 'excluir']);
    Route::get('/update/{id}', [CorController::class, 'alterar']);
    Route::post('/update', [CorController::class, 'salvar_update']);
});

Route::group(['prefix'=>'produto'], function(){
    Route::get('/', [ProdutoController::class, 'index'])->name('produto.index');
    Route::get('/novo', [ProdutoController::class, 'inserir']);
    Route::post('/novo', [ProdutoController::class, 'salvar_novo']);
    Route::get('/excluir/{id}', [ProdutoController::class, 'excluir']);
    Route::get('/update/{id}', [ProdutoController::class, 'alterar']);
    Route::get('/show', [ProdutoController::class, 'show'])->name('produto.show');
    Route::post('/update', [ProdutoController::class, 'salvar_update']);
    Route::get('/filtrar', [ProdutoController::class, 'filtrar'])->name('produto.filtrar');

});

Route::get('/',[LojaController::class, 'index'])->name('produto.show');

Route::group(['prefix'=>'carrinho'], function(){
    Route::get('/', [CarrinhoController::class, 'index'])->name('carrinho.index')->defaults('tipo', 'carrinho');
    Route::post('/adicionar/{produto}', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
    Route::post('/remover/{produto}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
    Route::put('/{produto}', [CarrinhoController::class, 'update'])->name('carrinho.update');
});

Route::group(['prefix'=>'checkout'], function(){
    Route::get('/', [CarrinhoController::class, 'mostrarCheckout'])->name('carrinho.mostrarCheckout')->defaults('tipo', 'carrinho');
    Route::post('/', [CarrinhoController::class, 'processarCheckout'])->name('carrinho.processarCheckout');
});

Route::get('/compras', [ComprasController::class, 'index'])->name('compras.index');

Route::get('/produtos/filtrar-por-marca/{marca_id}', 'ProdutoController@filtrarPorMarca')->name('produtos.filtrarPorMarca');


Route::group(['prefix'=> 'loja'], function(){
    Route::get('/',[LojaController::class, 'index']);
    Route::get('/consultamarca/{id}',[LojaController::class, 'consultamarca'])->name('loja.consultamarca');
    Route::get('/consultacategoria/{id}',[LojaController::class, 'consultacategoria'])->name('loja.consultacategoria');
});
