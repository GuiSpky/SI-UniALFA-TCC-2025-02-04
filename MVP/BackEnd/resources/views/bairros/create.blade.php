@extends('app')
@section('tittle', 'Nova Cidade')
@section('content')
    <h1>Nova Cidade</h1>
    <form action="{{ route('cidades.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome">
        </div>
        <div class="form-group mb-3">
            <label>Selecione a Cidade</label>
            <select name="id_cidade" class="form-control" required>
                <option value="">-- Escolha uma cidade --</option>
                @foreach ($cidades as $cidade)
                    <option value="{{ $cidade->id }}">{{ $cidade->nome }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success" type="submit">Enviar</button>
        <a class="btn btn-danger" href="{{route('bairros.index')}}">Cancelar</a>
    </form>
@endsection
