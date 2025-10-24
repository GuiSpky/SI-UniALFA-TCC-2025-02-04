@extends('layouts.app')
@section('title', 'Editar Produto')
@section('content')

<h1>Editar Escola</h1>
    <form action="{{ route('produtos.update', $produto) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" placeholder={{$produto->nome}} value="{{$produto->nome}}">
        </div>
        <div class="form-group mb-3">
            <label>Selecione a Cidade</label>
            <select name="grupo" class="form-control" required>
                <option value="">-- Escolha uma classe --</option>
                <option value="proteina">Proteina</option>
                <option value="carboidratos">Carboidratos</option>
                <option value="oleogenosos">Oleogenosos</option>
                <option value="fibras">Fibras</option>
            </select>
        </div>
        <button class="btn btn-success" type="submit">Enviar</button>
        <a class="btn btn-danger" href="{{route('escolas.index')}}">Cancelar</a>
    </form>
@endsection
