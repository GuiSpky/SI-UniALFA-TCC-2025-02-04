@extends('app')
@section('tittle', 'Detalhe da Cidade')
@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes da Cidade {{$cidade->nome}}
        </div>
        <div class="card-body">
            <p><strong>Cód. IBGE: </strong>{{$cidade->codIbge}}</p>
            <p><strong>Nome: </strong>{{$cidade->nome}}</p>
            <p><strong>UF: </strong>{{$cidade->uf}}</p>
            <br>
            <a class="btn btn-success" href="{{ route('cidades.index') }}">Voltar</a>
        </div>
    </div>
@endsection
