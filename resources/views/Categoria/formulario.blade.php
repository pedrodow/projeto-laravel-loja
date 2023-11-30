@extends('TemplateAdmin.index')

@section('contents')

@php
    $titulo = "Inclusão de uma nova marca";
    $endpoint = "/categoria/novo";
    $input_nome="";
    $input_fantasia="";
    $input_id="";

    if(isset($categoria)){
        $titulo = "Alteração de marca";
        $endpoint = "/categoria/update";
        $input_nome= $categoria['nome'];
        $input_id = $categoria["id"];
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

            <label class="form-label">Nome da Categoria</label>
            <input class="form-control" name="nome" placeholder="Nome" value="{{$input_nome}}">

            <label class="form-label">Situação</label>
            <select class="form-control" name="situacao">
                <option value="1" selected>ATIVO</option>
                <option value="0">INATIVO</option>
            </select>

            <br/>
            <input type="submit" class="btn btn-success" value="SALVAR"/>

        </form>
    </div>
</div>
@endsection
