<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Marca;
use App\Models\Categoria;

class LojaController extends Controller
{
    public function index($tipo = 'loja')
    {
        $dadosSelect = $this->select();

        $dados = Produto::select("produto.id", "produto.nome", "produto.quantidade AS quantidade", "produto.preco AS preco", "produto.descricao AS descricao", "categoria.nome AS categoria", "marca.nome AS marca")
            ->join("categoria", "categoria.id", "=", "produto.id_categoria")
            ->join("marca", "marca.id", "=", "produto.id_marca")
            ->get();

            $view = match ($tipo) {
                'loja' => 'loja.index',
                'carrinho' => 'carrinho.index',
                'checkout' => 'carrinho.checkout',
                default => 'loja.index',
            };

            return view($view, [
                'produto' => $dados,
                'marcas' => $dadosSelect['marcas'],
                'categorias' => $dadosSelect['categorias']
            ]);
    }

    public function consultamarca($id, $tipo = 'loja'){

        $dadosSelect = $this->select();

        $dados = Produto::select("produto.id", "produto.nome", "produto.quantidade AS quantidade", "produto.preco AS preco", "produto.descricao AS descricao", "categoria.nome AS categoria", "marca.nome AS marca")
            ->join("categoria", "categoria.id", "=", "produto.id_categoria")
            ->join("marca", "marca.id", "=", "produto.id_marca")
            ->where("marca.id", $id)
            ->get();

            $view = match ($tipo) {
                'loja' => 'loja.index',
                'carrinho' => 'carrinho.index',
                'checkout' => 'carrinho.checkout',
                default => 'loja.index',
            };

            return view($view, [
                'produto' => $dados,
                'marcas' => $dadosSelect['marcas'],
                'categorias' => $dadosSelect['categorias']
            ]);
    }

    public function consultacategoria($id, $tipo = 'loja'){

        $dadosSelect = $this->select();

        $dados = Produto::select("produto.id", "produto.nome", "produto.quantidade AS quantidade", "produto.preco AS preco", "produto.descricao AS descricao", "categoria.nome AS categoria", "marca.nome AS marca")
            ->join("categoria", "categoria.id", "=", "produto.id_categoria")
            ->join("marca", "marca.id", "=", "produto.id_marca")
            ->where("categoria.id", $id)
            ->get();

            $view = match ($tipo) {
                'loja' => 'loja.index',
                'carrinho' => 'carrinho.index',
                'checkout' => 'carrinho.checkout',
                default => 'loja.index',
            };

            return view($view, [
                'produto' => $dados,
                'marcas' => $dadosSelect['marcas'],
                'categorias' => $dadosSelect['categorias']
            ]);
    }
    private function select()
    {
        $marcas = Marca::all()->toArray();
        $categorias = Categoria::all()->toArray();
        return [
            'marcas' => $marcas,
            'categorias' => $categorias
        ];
    }
}
