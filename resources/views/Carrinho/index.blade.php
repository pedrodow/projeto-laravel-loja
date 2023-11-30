@extends('templateCarrinho.index')


@section('contents')

<h1>Meu Carrinho de Compras</h1>

    @if(!empty($carrinho))
        <ul>
            @foreach($carrinho as $produtoId => $item)
                <li>
                    {{ $item['produto']->nome }} - R$ {{ $item['produto']->preco }}
                    <br>
                    Quantidade:
                    <form action="{{ route('carrinho.update', $item['produto']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" name="change_quantidade" value="decrease" class="btn btn-outline-dark">-</button>
                        {{ $item['quantidade'] }}
                        <button type="submit" name="change_quantidade" value="increase" class="btn btn-outline-dark">+</button>
                    </form>
                    <form action="{{ route('carrinho.remover', $item['produto']) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark">Remover</button>
                    </form>
                </li>
            @endforeach

            <p>Preço total: R$ {{ $precoTotal }}</p>

            <form action="{{ route('carrinho.processarCheckout') }}" method="POST">
                @csrf

                <label for="nome_cliente">Nome:</label>
                <input type="text" id="nome_cliente" name="nome_cliente" required>
                <br>
                <label for="email_cliente">Email:</label>
                <input type="email" id="email_cliente" name="email_cliente" required>
                <br>
                <button type="submit" class="btn btn-outline-dark">Finalizar a compra</button>
            </form>
        </ul>
    @else
        <p>O seu carrinho está vazio.</p>
    @endif

        <a href="{{ route('produto.show') }}">
            <button class="btn btn-outline-dark">Voltar para Produtos</button>
        </a>

@endsection
