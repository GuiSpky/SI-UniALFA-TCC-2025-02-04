@extends('layouts.app')
@section('tittle', 'Detalhe da Cidade')
@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes do bairro {{$bairro->nome}}
        </div>
        <div class="card-body">
            <p><strong>ID: </strong>{{$bairro->id}}</p>
            <p><strong>Nome: </strong>{{$bairro->nome}}</p>
            <p><strong>Cidade: </strong>{{ $cidades->where('id', $bairro->id_cidade)->pluck('nome')->first()}}</p>
            <br>
            <a class="btn btn-success" href="{{ route('bairros.index') }}">Voltar</a>
        </div>
    </div>
@endsection
