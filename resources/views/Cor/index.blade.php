@extends('TemplateAdmin.index')

@section('contents')
    <h1 class="h3 mb-4 text-gray-800">Cor dos produtos</h1>

    <div class="card">
        <div class="card-header">
            Lista de cores
        </div>
        <div class="card-body">

            <a href="/cor/novo" class="btn btn-success">
                Novo
            </a>

            <table class="table table-bordered dataTable">
                <thead>
                    <td>ID</td>
                    <td>Cor</td>
                    <td>Opções</td>
                </thead>
                <tbody>
                    @foreach ($cor as $linha)
                        <tr>
                            <td>{{ $linha['id'] }}</td>
                            <td>{{ $linha['cor'] }}</td>
                            <td>
                                <a href="/cor/update/{{ $linha['id'] }}" class="btn btn-success">
                                    <li class=" fa fa-edit"></li>
                                </a>
                                <a href="/cor/excluir/{{ $linha['id'] }}" class="btn btn-danger">
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
