<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Pedido;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\DetalhePedido;


class CarrinhoController extends Controller
{
    public function index(Request $request)
    {
        $produto = Produto::all();

        if ($request->has('id')) {
            $idProduto = $request->input('produto_id');
            $produto = Produto::find($idProduto);

            $carrinho = $request->session()->get('carrinho', []);
            $carrinho[$produto->id]['produto'] = $produto;
            $carrinho[$produto->id]['quantidade'] = isset($carrinho[$produto->id]['quantidade']) ? $carrinho[$produto->id]['quantidade'] + 1 : 1;

            $request->session()->put('carrinho', $carrinho);

            return redirect()->route('carrinho.index');
        }

        $carrinho = $request->session()->get('carrinho', []);

        $precoTotal = $this->precoTotal($request);

        $dadosSelect = $this->select();

        return view('carrinho.index', [
            'produto' => $produto,
            'marcas' => $dadosSelect['marcas'],
            'categorias' => $dadosSelect['categorias']
        ], compact('carrinho', 'precoTotal'));
    }

    public function adicionar(Request $request, Produto $produto)
    {
        $carrinho = $request->session()->get('carrinho', []);

        $idProduto = $produto->id;

        if (!isset($carrinho[$idProduto])) {
            $carrinho[$idProduto] = [
                'produto' => $produto,
                'quantidade' => 1,
            ];
        } else {
            $carrinho[$idProduto]['quantidade']++;
        }

        $request->session()->put('carrinho', $carrinho);

        return redirect()->route('carrinho.index');
    }

    public function remover(Request $request, Produto $produto)
    {
        $carrinho = $request->session()->get('carrinho', []);

        $idProduto = $produto->id;

        if (isset($carrinho[$idProduto])) {
            unset($carrinho[$idProduto]);
            $request->session()->put('carrinho', $carrinho);
        }

        return redirect()->route('carrinho.index');
    }

    public function update(Request $request, Produto $produto)
    {
        $carrinho = $request->session()->get('carrinho', []);

        $idProduto = $produto->id;

        if (isset($carrinho[$idProduto])) {
            $changeType = $request->input('change_quantidade');

            if ($changeType === 'decrease' && $carrinho[$idProduto]['quantidade'] === 1) {
                unset($carrinho[$idProduto]);
                $request->session()->put('carrinho', $carrinho);
                return redirect()->route('carrinho.index');
            }

            if ($changeType === 'increase') {
                $carrinho[$idProduto]['quantidade']++;
            } elseif ($changeType === 'decrease' && $carrinho[$idProduto]['quantidade'] > 1) {
                $carrinho[$idProduto]['quantidade']--;
            }

            $request->session()->put('carrinho', $carrinho);
        }

        return redirect()->route('carrinho.index');
    }

    public function precoTotal(Request $request)
    {
        $carrinho = $request->session()->get('carrinho', []);

        $precoTotal = 0;

        foreach ($carrinho as $item) {
            $precoTotal += $item['produto']->preco * $item['quantidade'];
        }

        return $precoTotal;

    }

    public function mostrarCheckout()
    {
        return view('carrinho.checkout');
    }

    public function processarCheckout(Request $request)
    {
        $name = $request->input('nome_cliente');
        $email = $request->input('email_cliente');

        $pedido = Pedido::create([
            'nome_cliente' => $name,
            'email_cliente' => $email,
        ]);

        $carrinho = $request->session()->get('carrinho', []);

        foreach ($carrinho as $idProduto => $item) {
            DetalhePedido::create([
                'pedido_id' => $pedido->id,
                'produto_id' => $idProduto,
                'quantidade' => $item['quantidade'],
            ]);
        }

        $request->session()->forget('carrinho');

        return view('carrinho.checkout', compact('name', 'email'));
    }

    public function consultamarca($id, $tipo = 'loja')
    {
        $dadosSelect = $this->select();

        $dados = Produto::select("produto.id", "produto.nome", "produto.quantidade AS quantidade", "produto.preco AS preco", "produto.descricao AS descricao", "categoria.nome AS categoria", "marca.nome AS marca")
        ->join("categoria", "categoria.id", "=", "produto.id_categoria")
        ->join("marca", "marca.id", "=", "produto.id_marca")
        ->where("marca.id", $id)->get();

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

    public function consultacategoria($id, $tipo = 'loja')
    {
        $dadosSelect = $this->select();

        $dados = Produto::select("produto.id", "produto.nome", "produto.quantidade AS quantidade", "produto.preco AS preco", "produto.descricao AS descricao", "categoria.nome AS categoria", "marca.nome AS marca")
        ->join("categoria", "categoria.id", "=", "produto.id_categoria")
        ->join("marca", "marca.id", "=", "produto.id_marca")
        ->where("categoria.id", $id)->get();

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

    public function select()
    {
        $marcas = Marca::all()->toArray();
        $categorias = Categoria::all()->toArray();

        return [
            'marcas' => $marcas,
            'categorias' => $categorias
        ];
    }

}
