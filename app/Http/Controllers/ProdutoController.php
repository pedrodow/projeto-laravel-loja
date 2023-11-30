<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produto;
use App\Models\Categoria;
use App\Models\Marca;

class ProdutoController extends Controller{
    public function index(){
        $produto = produto::select("produto.id", "produto.nome", "produto.quantidade", "produto.descricao", "produto.preco", "categoria.nome AS cat", "marca.nome AS marca")->join("categoria", "categoria.id", "=", "produto.id_categoria")->join("marca", "marca.id", "=", "produto.id_marca")->get();
        return View("produto.index",["produto" => $produto]);
        var_dump($produto);
    }

    public function salvar_novo(Request $request){
        $produto = new Produto;
        $produto-> nome = $request->input('nome');
        $produto-> id_categoria = $request->input('id_categoria');
        $produto-> preco = $request->input('preco');
        $produto-> quantidade = $request->input('quantidade');
        $produto-> id_marca = $request->input('id_marca');
        $produto-> descricao = $request->input('descricao');
        $produto->save();
        return redirect("/produto");
        exit;
    }


    public function inserir(){
        $categoria = Categoria::all()->toArray();
        $marca = Marca::all()->toArray();
        return View("produto.formulario", ['categorias' => $categoria, 'marcas' => $marca]);
    }

    public function excluir($id){
        $produto = produto::find($id);
        $produto->delete();
        return redirect('/produto');
    }

    public function alterar($id){
        $produto = produto::find($id)->toArray();
        $marca = Marca::all()->toArray();
        $categoria = Categoria::all()->toArray();
        return View("produto.formulario", ['produto' => $produto, 'categorias' => $categoria, 'marcas' => $marca]);
    }

    public function salvar_update(Request $request){
        $produto = produto::find($request->input("id"));
        $produto-> nome = $request->input('nome');
        $produto-> id_categoria = $request->input('id_categoria');
        $produto-> preco = $request->input('preco');
        $produto-> quantidade = $request->input('quantidade');
        $produto-> id_marca = $request->input('id_marca');
        $produto-> descricao = $request->input('descricao');
        $produto-> save();
        return redirect('/produto');
    }

    public function show()
    {
        $produtos = Produto::all();
        return view('produto.mostrar', compact('produtos'));
    }
}
