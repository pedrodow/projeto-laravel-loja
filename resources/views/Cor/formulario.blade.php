@extends('TemplateAdmin.index')

@section('contents')

@php
    $titulo = "Inclusão de uma nova cor";
    $endpoint = "/cor/novo";
    $input_cor="";
    $input_id="";

    if(isset($cor)){
        $titulo = "Alteração da cor";
        $endpoint = "/cor/update";
        $input_cor= $cor['cor'];
        $input_id = $cor["id"];
    }

@endphp

    <h1 class="h3 mb-4 text-gray-800">{{$titulo}}</h1>
    <div class="card">
        <div class="card-header">
            Criar nova marca
        </div>
        <div class="card-body">
            <form method="post" action="{{$endpoint}}">
                @CSRF
                <input type="hidden" name="id" value={{$input_id}}/>

                <label class="form-label">Nome da cor</label>
                <input class="form-control" name="cor" placeholder="Cor" value={{$input_cor}}>

                <label class="form-label">Situacao</label>
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
