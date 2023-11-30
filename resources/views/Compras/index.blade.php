@extends('TemplateAdmin.index')

@section('contents')

    <h1>Lista de Compras</h1>

    @foreach($compras as $pedido_id => $detalhes)
        @php
            $email = $emails[$pedido_id] ?? 'N/A';
        @endphp
        <h2>Pedido {{ $pedido_id }} - Email: {{ $email }}</h2>
        <table class="table table-bordered dataTable">
            <thead>
                <tr>
                    <th>ID do Produto</th>
                    <th>Nome do Produto</th>
                    <th>Preço do Produto</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalhes as $compra)
                    <tr>
                        <td>{{ $compra->produto->id }}</td>
                        <td>{{ $compra->produto->nome }}</td>
                        <td>{{ $compra->produto->preco }}</td>
                        <td>{{ $compra->quantidade }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <p>Valor Total: R$ {{ $valorTotal[$pedido_id] }}</p>
    @endforeach

    @endsection
