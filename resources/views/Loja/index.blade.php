@extends('TemplateLoja.index')

@section('contents')

<h1>Produtos Disponiveis</h1>

<section class="py-5">
    <table class="table table-striped">
        <thead class="thead">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Marca</th>
                <th scope="col">Categoria</th>
                <th scope="col">Preço</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produto as $linha)
            <tr>
                <td>{{ $linha['id'] }}</td>
                <td>{{ $linha['nome'] }}</td>
                <td>{{ $linha['marca'] }}</td>
                <td>{{ $linha['categoria'] }}</td>
                <td>{{ number_format($linha['preco']) }}</td>
                <td>
                    <form action="{{ route('carrinho.adicionar', $linha) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-dark">Adicionar ao Carrinho</button>
                </form>
                </td
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection