@extends('layouts.app')
@section('title', 'Nova Cidade')
@section('content')
    <h1>Nova Cidade</h1>
    <form action="{{ route('cidades.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="codIbge" class="form-label">Cód. IBGE</label>
            <input type="number" name="codIbge" id="codIbge" class="form-control" placeholder="Digite o nome">
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome">
        </div>
        <div class="mb-3">
            <label for="uf" class="form-label">UF</label>
            <input type="text" name="uf" id="uf" class="form-control" placeholder="Digite o cpf">
        </div>
        <button class="btn btn-success" type="submit">Enviar</button>
        <a class="btn btn-danger" href="{{route('cidades.index')}}">Cancelar</a>
    </form>
@endsection
