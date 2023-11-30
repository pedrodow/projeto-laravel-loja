@extends('templateCarrinho.index')


@section('contents')

<h1>Checkout</h1>

<p>Nome do Comprador: {{ $name }}</p>
<p>Email do Comprador: {{ $email }}</p>

<p>Obrigado por sua compra!</p>

<a href="{{ route('produto.show') }}">
    <button class="btn btn-outline-dark">Voltar a tela inicial</button>
</body>
</html>

@endsection
