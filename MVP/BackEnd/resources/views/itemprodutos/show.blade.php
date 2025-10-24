@extends('layouts.app')
@section('title', 'Detalhe do Produto')
@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom-0">
            Detalhes do Produto {{ $item->where('id', $produto->id_produto)->pluck('nome')->first()}}
        </div>
        <div class="card-body">
            <p><strong>Id: </strong>{{$produto->id}}</p>
            <p><strong>Nome: </strong>{{ $item->where('id', $produto->id_produto)->pluck('nome')->first()}}</p>
            <p><strong>Grupo: </strong>{{ $item->where('id', $produto->id_produto)->pluck('grupo')->first()}}</p>
            <p><strong>Quantidade: </strong>{{$produto->quantidade}}</p>
            <p><strong>Validade: </strong>{{$cidade->uf}}</p>
            <p><strong>Entrada: </strong>{{$cidade->uf}}</p>
            <p><strong>Local: </strong>{{$cidade->uf}}</p>
            <br>
            <a class="btn btn-success" href="{{ route('cidades.index') }}">Voltar</a>
        </div>
    </div>
@endsection
