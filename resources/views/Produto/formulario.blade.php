@extends('TemplateAdmin.index')

@section('contents')

@php
    $titulo = "Inclusão de um novo produto";
    $endpoint = "/produto/novo";
    $input_nome="";
    $input_id_categoria="";
    $input_id="";
    $input_id_marca="";
    $input_descricao="";
    $input_preco="";
    $input_quantidade="";

    if(isset($produto)){
        $titulo = "Alteração de marca";
        $endpoint = "/produto/update";
        $input_nome= $produto['nome'];
        $input_id_categoria = $produto['id_categoria'];
        $input_id= $produto['id'];
        $input_id_marca= $produto['id_marca'];
        $input_descricao= $produto['descricao'];
        $input_preco= $produto['preco'];
        $input_quantidade= $produto['quantidade'];
    }

@endphp


<h1 class="h3 mb-4 text-gray-800">{{$titulo}}</h1>
<div class="card">
    <div class="card-header">
        Criar nova categoria
    </div>
    <div class="card-body">
        <form method="post" action={{$endpoint}}>
            @CSRF
            <input type="hidden" name="id" value={{$input_id}}/>

            <label class="form-label">Nome do produto</label>
            <input class="form-control" name="nome" placeholder="Nome" value="{{$input_nome}}">

            <label class="form-label">Categoria</label>
            <select class="form-control" name="id_categoria" value="{{$input_id_categoria}}">
                @foreach ($categorias as $categoria)
                    @if($categoria["id"] == $input_id_categoria)
                        <option value="{{ $categoria["id"] }}" selected >{{ $categoria["nome"] }}</option>
                    @else
                        <option value="{{ $categoria["id"] }}">{{ $categoria["nome"] }}</option>
                    @endif
                @endforeach
            </select>

            <label class="form-label">Marca</label>
            <select class="form-control" name="id_marca" value="{{$input_id_marca}}">
                @foreach ($marcas as $marca)
                    @if($marca["id"] == $input_id_marca)
                        <option value="{{ $marca["id"] }}" selected>{{ $marca["nome"] }}</option>
                    @else
                        <option value="{{ $marca["id"] }}">{{ $marca["nome"] }}</option>
                    @endif
                @endforeach
            </select>

            <label class="form-label">Preço</label>
            <input class="form-control" name="preco" placeholder="" value="{{$input_preco}}">

            <label class="form-label">Quantidade</label>
            <input class="form-control" name="quantidade" placeholder="" value="{{$input_quantidade}}">

            <label class="form-label">Descricao</label>
            <div class="container mt-4 mb-4">
                <div class="row justify-content-md-center">
                    <div class="col-md-12 col-lg-8">
                        <h1 class="h2 mb-4">Submit issue</h1>
                        <label>Describe the issue in detail</label>
                        <div class="form-group">
                            <textarea id="editor" name="descricao" value="{{$input_descricao}}">{{$input_descricao}}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <br/>
            <input type="submit" class="btn btn-success" value="SALVAR"/>

        </form>
    </div>
</div>
@endsection
