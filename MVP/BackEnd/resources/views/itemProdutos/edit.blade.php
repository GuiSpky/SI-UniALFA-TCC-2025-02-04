@extends('layouts.app')
@section('title', 'Editar Cidade')
@section('content')

<h1>Editar Cidade</h1>
    <form action="{{ route('cidades.update', $cidade) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="codIbge" class="form-label">Cód. IBGE</label>
            <input type="number" name="codIbge" id="codIbge" class="form-control" placeholder={{$cidade->codIbge}} value="{{$cidade->codIbge}}">
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" placeholder={{$cidade->nome}} value="{{$cidade->nome}}">
        </div>
        <div class="mb-3">
            <label for="uf" class="form-label">UF</label>
            <input type="text" name="uf" id="uf" class="form-control" placeholder={{$cidade->uf}} value="{{$cidade->uf}}">
        </div>
        <button class="btn btn-success" type="submit">Enviar</button>
        <a class="btn btn-danger" href="{{route('cidades.index')}}">Cancelar</a>
    </form>
@endsection
