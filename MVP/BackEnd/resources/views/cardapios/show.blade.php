@extends('app')
@section('tittle', 'Detalhe do Cardápio')
@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes do Cardápio {{$cardapio->nome}}
        </div>
        <div class="card-body">
            <p><strong>ID: </strong>{{$cardapio->id}}</p>
            <p><strong>Nome: </strong>{{$cardapio->nome}}</p>
            <p><strong>Item: </strong>{{ $cardapio->item}}</p>
            <p><strong>Item: </strong>{{ $cardapio->data}}</p>
            <br>
            <a class="btn btn-success" href="{{ route('cardapios.index') }}">Voltar</a>
        </div>
    </div>
@endsection
