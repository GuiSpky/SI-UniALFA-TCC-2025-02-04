@extends('app')
@section('tittle', 'Detalhe da Escola')
@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes da Escola {{$escola->nome}}
        </div>
        <div class="card-body">
            <p><strong>ID: </strong>{{$escola->id}}</p>
            <p><strong>Nome: </strong>{{$escola->nome}}</p>
            <p><strong>Cidade: </strong>{{ $cidades->where('id', $escola->id_cidade)->pluck('nome')->first()}}</p>
            <p><strong>Bairro: </strong>{{ $bairro->where('id', $escola->id_bairro)->pluck('nome')->first()}}</p>
            <br>
            <a class="btn btn-success" href="{{ route('bairros.index') }}">Voltar</a>
        </div>
    </div>
@endsection
