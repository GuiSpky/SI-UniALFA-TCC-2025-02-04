@extends('app')
@section('tittle', 'Editar Escola')
@section('content')

<h1>Editar Escola</h1>
    <form action="{{ route('escolas.update', $escola) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" placeholder={{$escola->nome}} value="{{$escola->nome}}">
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
        <div class="form-group mb-3">
            <label>Selecione o Bairro</label>
            <select name="id_bairro" class="form-control" required>
                <option value="">-- Escolha um bairro --</option>
                @foreach ($bairros as $bairro)
                    <option value="{{ $bairro->id }}">{{ $bairro->nome }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success" type="submit">Enviar</button>
        <a class="btn btn-danger" href="{{route('escolas.index')}}">Cancelar</a>
    </form>
@endsection
