<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class categoriaController extends Controller{
    public function index(){
        $dados = Categoria::all()->toArray();
        return View("Categoria.index",['categoria' => $dados]);
    }

    public function inserir(){
        return View("Categoria.formulario");
    }

    public function salvar_novo(Request $request){
        $categoria = new Categoria;
        $categoria->nome = $request->input("nome");
        $categoria->situacao = $request->input("situacao");
        $categoria->save();
        return redirect("/categoria");
        exit;
    }

    public function excluir($id){
        $categoria = Categoria::find($id);
        $categoria->delete();
        return redirect('/categoria');
    }

    public function alterar($id){
        $categoria = Categoria::find($id)->toArray();
        return View("Categoria.formulario", ['categoria' => $categoria]);
    }

    public function salvar_update(Request $request){
        $id = $request->input("id");
        $categoria = categoria::find($id);
        $categoria->nome = $request->input("nome");
        $categoria->situacao = $request->input("situacao");
        $categoria->save();
        return redirect('/categoria');
    }
}
