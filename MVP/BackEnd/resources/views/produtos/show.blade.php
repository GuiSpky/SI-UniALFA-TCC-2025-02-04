@extends('app')
@section('tittle', 'Detalhe da Escola')
@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes da Escola {{$produto->nome}}
        </div>
        <div class="card-body">
            <p><strong>ID: </strong>{{$produto->id}}</p>
            <p><strong>Nome: </strong>{{$produto->nome}}</p>
            <p><strong>Grupo: </strong>{{$produto->grupo}}</p>
            <br>
            <a class="btn btn-success" href="{{ route('bairros.index') }}">Voltar</a>
        </div>
    </div>
@endsection
