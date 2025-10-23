@extends('layouts.app')
@section('title', 'Detalhe da Escola')
@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom-0">
            Detalhes da Escola {{$escola->nome}}
        </div>
        <div class="card-body">
            <p><strong>ID: </strong>{{$escola->id}}</p>
            <p><strong>Nome: </strong>{{$escola->nome}}</p>
            <p><strong>Cidade: </strong>{{ $cidades->where('id', $ecola->id_cidade)->pluck('nome')->first()}}</p>
            <p><strong>Bairro: </strong>{{ $bairros->where('id', $ecola->id_bairro)->pluck('nome')->first()}}</p>
            <br>
            <a class="btn btn-success" href="{{ route('escolas.index') }}">Voltar</a>
        </div>
    </div>
@endsection

