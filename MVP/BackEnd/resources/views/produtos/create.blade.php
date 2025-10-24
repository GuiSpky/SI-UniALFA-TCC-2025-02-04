@extends('layouts.app')
@section('title', 'Novo produto')
@section('content')
    <h1>Novo produto</h1>
    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome">
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
        <a class="btn btn-danger" href="{{route('produtos.index')}}">Cancelar</a>
    </form>
@endsection
