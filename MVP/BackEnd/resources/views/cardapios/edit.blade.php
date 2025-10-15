@extends('app')
@section('tittle', 'Editar Cardápio')
@section('content')

<h1>Editar Cardápio</h1>
    <form action="{{ route('cardapios.update', $cardapio) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome" value="{{$cardapio->nome}}">
        </div>
        <div class="mb-3">
            <label for="iten" class="form-label">Item</label>
            <input type="text" name="item" id="item" class="form-control" placeholder="Digite os itens" value="{{$cardapio->item}}">
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" name="data" id="data" class="form-control" placeholder="Digite a Data" value="{{$cardapio->data}}">
        </div>


        <button class="btn btn-success" type="submit">Enviar</button>
        <a class="btn btn-danger" href="{{route('escolas.index')}}">Cancelar</a>
    </form>
@endsection
