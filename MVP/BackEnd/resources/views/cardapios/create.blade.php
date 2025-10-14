@extends('app')
@section('tittle', 'Novo Cardápios')
@section('content')
    <h1>Novo Cardápios</h1>
    <form action="{{ route('cardapios.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome">
        </div>
        <div class="mb-3">
            <label for="iten" class="form-label">Item</label>
            <input type="text" name="item" id="item" class="form-control" placeholder="Digite os itens">
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" name="data" id="data" class="form-control" placeholder="Digite a Data">
        </div>


        <button class="btn btn-success" type="submit">Enviar</button>
        <a class="btn btn-danger" href="{{route('cardapios.index')}}">Cancelar</a>
    </form>
@endsection
