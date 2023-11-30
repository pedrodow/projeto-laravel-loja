<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalhePedido;
use App\Models\Pedido;

class ComprasController extends Controller
{
    public function index()
    {
        $compras = DetalhePedido::with('produto')->get()->groupBy('pedido_id');

        $valorTotal = [];
        foreach ($compras as $pedido_id => $detalhes) {
            $valorTotal[$pedido_id] = $detalhes->sum(function ($detalhe) {
                return $detalhe->quantidade * $detalhe->produto->preco;
            });
        }

        $emails = Pedido::whereIn('id', array_keys($valorTotal))->pluck('email_cliente', 'id');

        return view('compras.index', [
            'compras' => $compras,
            'valorTotal' => $valorTotal,
            'emails' => $emails,
        ]);
    }
}
