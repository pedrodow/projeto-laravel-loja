@extends('TemplateAdmin.index')

@section('contents')
    <h1 class="h3 mb-4 text-gray-800">Cadastro de produtos</h1>

    <div class="card">
        <div class="card-header">
            Lista de produtos
        </div>
        <div class="card-body">

            <a href="/produto/novo" class="btn btn-success">
                Novo
            </a>

            <table class="table table-bordered dataTable">
                <thead>
                    <td>ID</td>
                    <td>Nome</td>
                    <td>Marca</td>
                    <td>Categoria</td>
                    <td>Descricao</td>
                    <td>Opções</td>
                </thead>
                <tbody>
                    @foreach ($produto as $dados)
                        <tr>
                            <td>{{ $dados['id'] }}</td>
                            <td>{{ $dados['nome'] }}</td>
                            <td>{{ $dados['marca']}}</td>
                            <td>{{ $dados['cat'] }}</td>
                            <td>
                                @php
                                    echo $dados['descricao'];
                                @endphp
                            </td>
                            <td>
                                <a href="/produto/update/{{ $dados['id'] }}" class="btn btn-success">
                                    <li class=" fa fa-edit"></li>
                                </a>
                                <a href="/produto/excluir/{{ $dados['id'] }}" class="btn btn-danger">
                                    <li class=" fa fa-trash"></li>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
